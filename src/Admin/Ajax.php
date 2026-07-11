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
        add_action('wp_ajax_pn_ai_test_provider', [$this, 'getModels']);
        add_action('wp_ajax_pn_ai_save_model', [$this, 'saveModel']);
        add_action('wp_ajax_pn_ai_provider_data', [$this, 'providerData']);
        add_action('wp_ajax_pn_ai_save_provider_settings', [$this, 'saveProviderSettings']);
        add_action('wp_ajax_pn_ai_chat', [$this, 'chat']);
        add_action('wp_ajax_nopriv_pn_ai_chat', [$this,'chat']);
    }

    public function getModels(): void
    {
        check_ajax_referer('pn_ai_agent');

        $provider = ProviderFactory::make();

        wp_send_json(
            $provider->getModels()
        );

    }

    public function saveModel(): void
    {
        check_ajax_referer('pn_ai_agent');

        $provider = sanitize_text_field(
            $_POST['provider'] ?? 'openai'
        );

        $model = sanitize_text_field(
            $_POST['model'] ?? ''
        );

        update_option(
            "pn_ai_{$provider}_model",
            $model
        );

        wp_send_json_success([
            'message' => 'Model saved.'
        ]);
    }

    public function providerData(): void
    {
        check_ajax_referer('pn_ai_agent');

        $provider = sanitize_text_field(
            $_POST['provider'] ?? 'openai'
        );

        $defaults = [
            'openai'     => 'https://api.openai.com/v1',
            'gemini'     => 'https://generativelanguage.googleapis.com/v1beta',
            'anthropic'  => 'https://api.anthropic.com/v1',
            'openrouter' => 'https://openrouter.ai/api/v1',
            'ollama'     => 'http://localhost:11434/api',
        ];

        wp_send_json_success([
            'url' => get_option(
                "pn_ai_{$provider}_api_url",
                $defaults[$provider] ?? ''
            ),
            'api_key' => get_option(
                "pn_ai_{$provider}_api_key",
                ''
            ),
            'model' => get_option(
                "pn_ai_{$provider}_model",
                ''
            ),
        ]);
    }

    public function saveProviderSettings(): void
    {
        check_ajax_referer('pn_ai_agent');

        $provider = sanitize_text_field($_POST['provider']);

        update_option('pn_ai_provider', $provider);

        update_option(
            "pn_ai_{$provider}_api_url",
            sanitize_text_field($_POST['api_url'])
        );

        update_option(
            "pn_ai_{$provider}_api_key",
            sanitize_text_field($_POST['api_key'])
        );

        update_option(
            "pn_ai_{$provider}_model",
            sanitize_text_field($_POST['model'])
        );

        wp_send_json_success([
            'message' => 'Settings saved.'
        ]);
    }


    public function chat(): void
    {
        check_ajax_referer('pn_ai_agent');

        $provider = \PNAIAgent\Providers\ProviderFactory::make();

        $prompt = sanitize_textarea_field(
            $_POST['prompt'] ?? ''
        );

        $result = $provider->chat($prompt);

        wp_send_json($result);
    }

    
}