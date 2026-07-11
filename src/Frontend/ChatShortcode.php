<?php

declare(strict_types=1);

namespace PNAIAgent\Frontend;

if (!defined('ABSPATH')) {
    exit;
}

final class ChatShortcode
{
    public function register(): void
    {
        add_shortcode(
            'pn_ai_chat',
            [$this, 'render']
        );
    }

    public function render($atts = [])
    {
        $atts = shortcode_atts(
            [
                'title' => __('AI Assistant', 'pn-ai-agent'),
                'height' => '500',
                'placeholder' => __('Write your message...', 'pn-ai-agent'),
                'button' => __('Send', 'pn-ai-agent'),
            ],
            $atts,
            'pn_ai_chat'
        );

        $title = $atts['title'];
        $height = (int)$atts['height'];
        $placeholder = $atts['placeholder'];
        $button = $atts['button'];

        ob_start();

        include PN_AI_AGENT_PATH.'src/Frontend/chat-template.php';

        return ob_get_clean();
    }
}

