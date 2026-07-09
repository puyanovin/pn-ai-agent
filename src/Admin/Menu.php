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
            __('PN AI Agent', 'pn-ai-agent'),
            __('PN AI Agent', 'pn-ai-agent'),
            'manage_options',
            'pn-ai-agent',
            [$this, 'dashboard']
        );
    }

    public function dashboard(): void
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        require PN_AI_AGENT_PATH . 'src/Admin/Views/dashboard.php';
    }
}