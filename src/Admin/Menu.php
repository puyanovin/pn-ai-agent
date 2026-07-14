<?php

declare(strict_types=1);

namespace PNAIAgent\Admin;

if (!defined('ABSPATH')) {
    exit;
}

final class Menu
{

    private const MENU_POSITION = 2;

    public function register(): void
    {
        add_action(
            'admin_menu',
            [$this, 'registerMenu']
        );
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
                self::MENU_POSITION
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
            [$this, 'tabsPage']
        );
    }

    public function dashboard(): void
    {
        $this->renderView('Dashboard');
    }

    public function tabsPage(): void
    {
        (new Router())->render();
    }
    
    private function renderView(string $view): void
    {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have permission to access this page.', 'pn-ai-agent'));
        }

        $file = PN_AI_AGENT_PATH . "src/Admin/{$view}.php";

        if (!file_exists($file)) {

           wp_die(
                sprintf(
                    /* translators: %s: Admin view name. */
                    __('View "%s" not found.', 'pn-ai-agent'),
                    esc_html($view)
                )
            );

        }
        require_once $file;
    }
}