<?php

declare(strict_types=1);

namespace PNAIAgent\Admin;

if (!defined('ABSPATH')) {
    exit;
}

final class Settings
{
    public function register(): void
    {
        add_action('admin_init', [$this, 'registerSettings']);
    }

    public function registerSettings(): void
    {
        register_setting(
            'pn_ai_agent_general',
            'pn_ai_provider',
            [
                'type' => 'string',
                'sanitize_callback' => 'sanitize_text_field',
                'default' => 'openai',
            ]
        );

        register_setting(
            'pn_ai_agent_general',
            'pn_ai_api_key',
            [
                'type' => 'string',
                'sanitize_callback' => 'sanitize_text_field',
            ]
        );

        register_setting(
            'pn_ai_agent_general',
            'pn_ai_api_url',
            [
                'type' => 'string',
                'sanitize_callback' => 'esc_url_raw',
            ]
        );

        register_setting(
            'pn_ai_agent_general',
            'pn_ai_model',
            [
                'type' => 'string',
                'sanitize_callback' => 'sanitize_text_field',
                'default' => 'gpt-4.1-mini',
            ]
        );
    }
}
