<?php

declare(strict_types=1);

namespace PNAIAgent\Admin;

if (!defined('ABSPATH')) {
    exit;
}

final class Menu
{
    public function register(): void
    {
        add_action('admin_menu', [$this, 'registerMenu'], 99);
    }

    public function registerMenu(): void
    {
        global $menu;

        $exists = false;

        if (is_array($menu)) {
            foreach ($menu as $item) {
                if (isset($item[2]) && $item[2] === 'pn-suite') {
                    $exists = true;
                    break;
                }
            }
        }

        if (!$exists) {
            add_menu_page(
                __('PN Suite', 'pn-ai-agent'),
                __('PN Suite', 'pn-ai-agent'),
                'manage_options',
                'pn-suite',
                [$this, 'dashboard'],
                'dashicons-admin-generic',
                2
            );
        }

        add_submenu_page(
            'pn-suite',
            __('Dashboard', 'pn-ai-agent'),
            __('Dashboard', 'pn-ai-agent'),
            'manage_options',
            'pn-suite',
            [$this, 'dashboard']
        );

        add_submenu_page(
            'pn-suite',
            __('PN AI Agent', 'pn-ai-agent'),
            __('PN AI Agent', 'pn-ai-agent'),
            'manage_options',
            'pn-ai-agent',
            [$this, 'agentPage']
        );
    }

    public function dashboard(): void
    {
        $this->renderView('dashboard');
    }

    public function agentPage(): void
    {
        $this->renderView('agent');
    }

    private function renderView(string $view): void
    {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have permission to access this page.', 'pn-ai-agent'));
        }

        $file = PN_AI_AGENT_PATH . "src/Admin/Views/{$view}.php";

        if (!file_exists($file)) {
            wp_die(sprintf(
                __('View "%s" not found.', 'pn-ai-agent'),
                esc_html($view)
            ));
        }

        require $file;
    }
}