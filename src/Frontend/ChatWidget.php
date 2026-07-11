<?php

declare(strict_types=1);

namespace PNAIAgent\Frontend;

class ChatWidget extends \WP_Widget
{
    public function __construct()
    {

        parent::__construct(
            'pn_ai_chat_widget',
            __('PN AI Chat', 'pn-ai-agent')
        );
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];

        echo do_shortcode('[pn_ai_chat]');

        echo $args['after_widget'];
    }

    public function form($instance)
    {
        echo '<p>PN AI Chat Widget</p>';
    }
}