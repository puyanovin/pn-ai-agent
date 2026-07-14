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

    public function widget($args, $instance): void
    {
        echo $args['before_widget'];

        echo do_shortcode('[pn_ai_chat]');

        echo $args['after_widget'];
    }

    public function form($instance): void
    {
        $title = $instance['title'] ?? __('PN AI Chat', 'pn-ai-agent');

        ?>
        <p>
            <label>
                <?php esc_html_e('Title:', 'pn-ai-agent'); ?>
            </label>

            <input
                class="widefat"
                name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                value="<?php echo esc_attr($title); ?>"
            >
        </p>
        <?php
    }

    public function update($new_instance, $old_instance): array
    {
        return [
            'title' => sanitize_text_field($new_instance['title'] ?? '')
        ];
    }
}