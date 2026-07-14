<?php

declare(strict_types=1);

namespace PNAIAgent\Admin;

if (!defined('ABSPATH')) {
    exit;
}

final class Assets
{

    private const NONCE = 'pn_ai_agent';

    public function register(): void
    {
        add_action('admin_enqueue_scripts', [$this, 'enqueue']);

        add_action('wp_enqueue_scripts',    [$this,'frontend']);
     
    }

    public function enqueue(string $hook): void
    {
        if (
            $hook !== 'toplevel_page_pn-suite' &&
            $hook !== 'pn-suite_page_pn-ai-agent'
        ) {
            return;
        }

        wp_enqueue_style(
            'pn-ai-agent-admin',
            PN_AI_AGENT_URL . 'assets/css/pn-admin.css',
            [],
            PN_AI_AGENT_VERSION
        );

        wp_enqueue_script(
            'pn-ai-agent-admin',
            PN_AI_AGENT_URL . 'assets/js/pn-admin.js',
            ['jquery'],
            PN_AI_AGENT_VERSION,
            true
        );

        wp_localize_script(
            'pn-ai-agent-admin',
            'pnAi',
            [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce'    => wp_create_nonce(self::NONCE),
                'i18n' => $this->i18n(true),
            ]
        );


    }

    public function frontend(): void
    {
        
        $post = get_post();

        if (
            !is_a($post, \WP_Post::class)
            || !has_shortcode($post->post_content, 'pn_ai_chat')
        ) {
            return;
        }

        wp_enqueue_style(
            'pn-ai-agent-front',
            PN_AI_AGENT_URL.'assets/css/pn-frontend.css',
            [],
            PN_AI_AGENT_VERSION
        );

        wp_enqueue_script(
            'pn-ai-agent-front',
            PN_AI_AGENT_URL.'assets/js/pn-frontend.js',
            ['jquery'],
            PN_AI_AGENT_VERSION,
            true
        );

        wp_localize_script(
            'pn-ai-agent-front',
            'pnAi',
            [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce'    => wp_create_nonce(self::NONCE),
                'i18n' => $this->i18n(false),
            ]
        );
        
    }

    private function i18n(bool $admin = true): array
    {
        $data = [
            'thinking' => __('Thinking...', 'pn-ai-agent'),
            'send'     => __('Send', 'pn-ai-agent'),
            'clear'    => __('Clear', 'pn-ai-agent'),
        ];

        if ($admin) {
            $data += [
                'testing' => __('Testing...', 'pn-ai-agent'),
                'connected' => __('Connected', 'pn-ai-agent'),
                'test_connection' => __('Test Connection', 'pn-ai-agent'),
                'cannot_load_models' => __('Cannot load models.', 'pn-ai-agent'),
                'unexpected_error' => __('An unexpected error occurred.', 'pn-ai-agent'),
                'connection_failed'  => __('Connection failed.', 'pn-ai-agent'),
                'load_models'        => __('Load Models', 'pn-ai-agent'),
                'save_settings'      => __('Save Settings', 'pn-ai-agent'),
                'unknown_error'      => __('Unknown error.', 'pn-ai-agent'),
                'connection_error'   => __('Connection error.', 'pn-ai-agent'),
            ];
        }

        return $data;
    }
    
}

