<?php

declare(strict_types=1);

namespace PNAIAgent\Admin;

if (!defined('ABSPATH')) {
    exit;
}

final class Assets
{
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
            PN_AI_AGENT_URL . 'assets/css/admin.css',
            [],
            PN_AI_AGENT_VERSION
        );

        wp_enqueue_script(
            'pn-ai-agent-admin',
            PN_AI_AGENT_URL . 'assets/js/admin.js',
            ['jquery'],
            PN_AI_AGENT_VERSION,
            true
        );

        wp_localize_script(
            'pn-ai-agent-admin',
            'pnAi',
            [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce'    => wp_create_nonce('pn_ai_agent'),

                'i18n' => [

                    'testing'            => __('Testing...', 'pn-ai-agent'),
                    'connected'          => __('Connected', 'pn-ai-agent'),
                    'connection_failed'  => __('Connection failed.', 'pn-ai-agent'),
                    'cannot_load_models' => __('Cannot load models.', 'pn-ai-agent'),
                    'load_models'        => __('Load Models', 'pn-ai-agent'),
                    'save_settings'      => __('Save Settings', 'pn-ai-agent'),
                    'test_connection'    => __('Test Connection', 'pn-ai-agent'),
                    'thinking'           => __('Thinking...', 'pn-ai-agent'),
                    'send'               => __('Send', 'pn-ai-agent'),
                    'clear'              => __('Clear', 'pn-ai-agent'),

                ]
            ]
        );


    }

    public function frontend(): void
    {
        wp_enqueue_style(
            'pn-ai-agent-front',
            PN_AI_AGENT_URL.'assets/css/frontend.css',
            [],
            PN_AI_AGENT_VERSION
        );

        wp_enqueue_script(
            'pn-ai-agent-front',
            PN_AI_AGENT_URL.'assets/js/frontend.js',
            ['jquery'],
            PN_AI_AGENT_VERSION,
            true
        );

        wp_localize_script(
            'pn-ai-agent-front',
            'pnAi',
            [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce'    => wp_create_nonce('pn_ai_agent'),

                'i18n' => [

                    'thinking' => __('Thinking...', 'pn-ai-agent'),
                    'send'     => __('Send', 'pn-ai-agent'),
                    'clear'    => __('Clear', 'pn-ai-agent'),

                ]
            ]
        );
        
    }
    
}

