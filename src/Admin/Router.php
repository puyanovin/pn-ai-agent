<?php

declare(strict_types=1);

namespace PNAIAgent\Admin;

if (!defined('ABSPATH')) {
    exit;
}

final class Router
{
    public function render(): void
    {
        $tab = sanitize_key(
            $_GET['tab'] ?? 'general'
        );

        ?>

        <div class="wrap">

            <h1>
                <?php esc_html_e('PN AI Agent', 'pn-ai-agent'); ?>
            </h1>

            <?php Tabs::render($tab); ?>

            <?php $this->loadView($tab); ?>

        </div>

        <?php
    }


    private function loadView(string $tab): void
    {

        $allowed = [
            'general',
            'providers',
            'models',
            'agent',
            'mcp',
            'knowledge',
            'chat',
            'images',
            'users',
            'logs',
            'license',
        ];


        if (!in_array($tab, $allowed, true)) {
            $tab = 'general';
        }


        $file = PN_AI_AGENT_PATH .
            'src/Admin/Views/' .
            $tab .
            '.php';


        if (file_exists($file)) {

            require $file;

        } else {

            require PN_AI_AGENT_PATH .
                'src/Admin/Views/general.php';

        }

    }
}