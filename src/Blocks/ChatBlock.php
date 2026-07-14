<?php

declare(strict_types=1);

namespace PNAIAgent\Blocks;

if (!defined('ABSPATH')) {
    exit;
}

final class ChatBlock
{
    public function register(): void
    {
        add_action(
            'init',
            [$this, 'init']
        );
    }

    public function init(): void
    {
        $path = PN_AI_AGENT_PATH . 'src/Blocks';

        if (!file_exists($path . '/block.json')) {
            return;
        }

        wp_register_script(
            'pn-ai-agent-block',
            PN_AI_AGENT_URL . 'src/Blocks/editor.js',
            [
                'wp-blocks',
                'wp-element',
                'wp-i18n',
                'wp-block-editor'
            ],
            PN_AI_AGENT_VERSION,
            true
        );

        register_block_type($path);
    }
}


