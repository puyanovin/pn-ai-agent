<?php

declare(strict_types=1);

namespace PNAIAgent\Admin;

if (!defined('ABSPATH')) {
    exit;
}

final class Page
{
    public static function render(string $title): void
    {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html($title); ?></h1>

            <div class="notice notice-info">
                <p>
                    <?php esc_html_e('This section is under development.', 'pn-ai-agent'); ?>
                </p>
            </div>
        </div>
        <?php
    }
}
