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

	add_submenu_page(
	    'pn-suite',
	    __('Providers', 'pn-ai-agent'),
	    __('Providers', 'pn-ai-agent'),
	    'manage_options',
	    'pn-ai-agent-providers',
	    [$this, 'providersPage']
	);

	add_submenu_page(
	    'pn-suite',
	    __('Models', 'pn-ai-agent'),
	    __('Models', 'pn-ai-agent'),
	    'manage_options',
	    'pn-ai-agent-models',
	    [$this, 'modelsPage']
	);

	add_submenu_page(
	    'pn-suite',
	    __('Agents', 'pn-ai-agent'),
	    __('Agents', 'pn-ai-agent'),
	    'manage_options',
	    'pn-ai-agent-agents',
	    [$this, 'agentsPage']
	);

	add_submenu_page(
	    'pn-suite',
	    __('MCP Tools', 'pn-ai-agent'),
	    __('MCP Tools', 'pn-ai-agent'),
	    'manage_options',
	    'pn-ai-agent-mcp',
	    [$this, 'mcpPage']
	);
    }

    public function dashboard(): void
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        require PN_AI_AGENT_PATH . 'src/Admin/Views/dashboard.php';
    }

    public function agentPage(): void
    {
    	if (!current_user_can('manage_options')) {
            return;
        }

	require PN_AI_AGENT_PATH . 'src/Admin/Views/agent.php';
    }

    public function providersPage(): void
    {
	require PN_AI_AGENT_PATH . 'src/Admin/Views/providers.php';
    }

    public function modelsPage(): void
    {
	Page::render(__('Models', 'pn-ai-agent'));
    }

    public function agentsPage(): void
    {
	Page::render(__('Agents', 'pn-ai-agent'));
    }

    public function mcpPage(): void
    {
	Page::render(__('MCP Tools', 'pn-ai-agent'));
    }
}
