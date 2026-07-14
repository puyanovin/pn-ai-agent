<?php

declare(strict_types=1);

namespace PNAIAgent\Core;

use PNAIAgent\Admin\Admin;
use PNAIAgent\Blocks\ChatBlock;
use PNAIAgent\Frontend\ChatShortcode;
use PNAIAgent\Frontend\ChatWidget;

if (!defined('ABSPATH')) {
    exit;
}

final class Application
{

    public static function boot(): void
    {
        $app = new self();

        add_action('plugins_loaded', [$app, 'loadTextdomain']);
        add_action('init', [$app, 'init']);
        add_action(
            'widgets_init',
            function(){

                register_widget(ChatWidget::class);

            }
        );


        (new self())->run();

    }

    public function loadTextdomain(): void
    {
        load_plugin_textdomain(
            'pn-ai-agent',
            false,
            dirname(PN_AI_AGENT_BASENAME) . '/languages'
        );
    }

    public function init(): void
    {
        (new ChatShortcode())->register();
        (new ChatBlock())->register();
    }


    public function run(): void
    {
        (new Admin())->register();
    }

}