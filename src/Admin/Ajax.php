<?php

declare(strict_types=1);

namespace PNAIAgent\Admin;

use PNAIAgent\Providers\ProviderFactory;

if (!defined('ABSPATH')) {
    exit;
}

final class Ajax
{

    public function register(): void
    {
        add_action('wp_ajax_pn_ai_get_models', [$this, 'getModels']);
        add_action('wp_ajax_pn_ai_save_model', [$this, 'saveModel']);
        add_action('wp_ajax_pn_ai_provider_data', [$this, 'providerData']);
        add_action('wp_ajax_pn_ai_save_provider_settings', [$this, 'saveProviderSettings']);
        add_action('wp_ajax_pn_ai_chat', [$this, 'chat']);
        add_action('wp_ajax_pn_ai_test_provider', [$this, 'testProvider']);
        add_action('wp_ajax_pn_ai_save_license', [$this, 'saveLicense']);
    }


    public function getModels(): void
    {
        check_ajax_referer('pn_ai_agent');

        $this->checkPermission();

        try {

            $provider = ProviderFactory::make(
                sanitize_text_field(
                    wp_unslash($_POST['provider'] ?? '')
                )
            );


            $models = $provider->getModels();


            wp_send_json_success([
                'models' => $models
            ]);


        } catch (\Throwable $e) {

            error_log('[PN AI Agent] ' . $e->getMessage());

            wp_send_json_error([
                'message' => $e->getMessage(),
                'models'  => []
            ]);

        }
    }


    public function saveModel(): void
    {
        check_ajax_referer('pn_ai_agent');

        $this->checkPermission();

        $provider = $this->allowedProvider(
            sanitize_text_field(
                wp_unslash($_POST['provider'] ?? 'openai')
            )
        );

        $model = sanitize_text_field(
            wp_unslash($_POST['model'] ?? '')
        );


        if ($model === '') {

            wp_send_json_error([
                'message' => __('Model is required.', 'pn-ai-agent'),
            ]);

        }


        update_option(
            "pn_ai_{$provider}_model",
            $model
        );


        wp_send_json_success([
            'message' => __('Model saved.', 'pn-ai-agent'),
        ]);
    }


    public function providerData(): void
    {
        check_ajax_referer('pn_ai_agent');

        $this->checkPermission();


        $provider = $this->allowedProvider(
            sanitize_text_field(
                wp_unslash($_POST['provider'] ?? 'openai')
            )
        );


        wp_send_json_success([

            'api_url' => get_option(
                "pn_ai_{$provider}_api_url",
                ProviderFactory::defaultUrl($provider)
            ),

            'api_key' => get_option(
                "pn_ai_{$provider}_api_key",
                ''
            ),

            'model' => get_option(
                "pn_ai_{$provider}_model",
                ProviderFactory::defaultModel($provider)
            ),

        ]);
    }



    public function saveProviderSettings(): void
    {
        check_ajax_referer('pn_ai_agent');

        $this->checkPermission();


        $provider = $this->allowedProvider(
            sanitize_text_field(
                wp_unslash($_POST['provider'] ?? 'openai')
            )
        );


        $apiUrl = esc_url_raw(
            wp_unslash($_POST['api_url'] ?? '')
        );


        $apiKey = sanitize_text_field(
            wp_unslash($_POST['api_key'] ?? '')
        );


        $model = sanitize_text_field(
            wp_unslash($_POST['model'] ?? '')
        );


        if ($apiUrl === '') {

            wp_send_json_error([
                'message' => __('API URL is required.', 'pn-ai-agent'),
            ]);

        }


        if ($apiKey === '' && $provider !== 'ollama') {

            wp_send_json_error([
                'message' => __('API Key is required.', 'pn-ai-agent'),
            ]);

        }


        if ($model === '') {

            wp_send_json_error([
                'message' => __('Model is required.', 'pn-ai-agent'),
            ]);

        }


        update_option(
            'pn_ai_provider',
            $provider
        );


        update_option(
            "pn_ai_{$provider}_api_url",
            $apiUrl
        );


        update_option(
            "pn_ai_{$provider}_api_key",
            $apiKey
        );


        update_option(
            "pn_ai_{$provider}_model",
            $model
        );


        wp_send_json_success([
            'message' => __('Settings saved.', 'pn-ai-agent'),
        ]);
    }



    public function chat(): void
    {
        check_ajax_referer('pn_ai_agent');

        $prompt = sanitize_textarea_field(
            wp_unslash($_POST['prompt'] ?? '')
        );


        if (trim($prompt) === '') {

            wp_send_json_error([
                'message' => __('Prompt is empty.', 'pn-ai-agent'),
            ]);

        }


        try {

            $provider = ProviderFactory::make();

            $result = $provider->chat($prompt);

            if (
                isset($result['success']) &&
                $result['success'] === true
            ) {

                wp_send_json_success(
                    $result['data'] ?? []
                );

            }


            wp_send_json_error([
                'message' =>
                    $result['data']['message']
                    ?? $result['message']
                    ?? __('Unknown error.', 'pn-ai-agent')
            ]);


        } catch (\Throwable $e) {

            error_log('[PN AI Agent] ' . $e->getMessage());


            wp_send_json_error([
                'message' => $e->getMessage(),
            ]);

        }
    }



    public function testProvider(): void
    {
        check_ajax_referer('pn_ai_agent');

        $this->checkPermission();


        try {


            $provider = ProviderFactory::make(
                sanitize_text_field(
                    wp_unslash($_POST['provider'] ?? '')
                )
            );

            wp_send_json(
                $provider->testConnection()
            );


        } catch (\Throwable $e) {


            error_log('[PN AI Agent] ' . $e->getMessage());


            wp_send_json_error([
                'message' => $e->getMessage(),
            ]);

        }

    }



    private function checkPermission(): void
    {
        if (!current_user_can('manage_options')) {

            wp_send_json_error([
                'message' => __('Permission denied.', 'pn-ai-agent'),
            ], 403);

        }
    }



    private function allowedProvider(string $provider): string
    {
        return in_array(
            $provider,
            ProviderFactory::ALLOWED_PROVIDERS,
            true
        )
            ? $provider
            : 'openai';
    }



    public function saveLicense(): void
    {
        check_ajax_referer('pn_ai_agent');

        $this->checkPermission();


        $license = sanitize_text_field(
            wp_unslash($_POST['license'] ?? '')
        );


        update_option(
            'pn_ai_license_key',
            $license
        );


        wp_send_json_success([
            'message' => __('License saved.', 'pn-ai-agent'),
        ]);
    }

}