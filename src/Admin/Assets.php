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
    }
}