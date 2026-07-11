<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="pn-chat">

    <div id="pn-chat-window" class="pn-chat-window"></div>

    <div class="pn-chat-input">

        <textarea
            id="pn-chat-message"
            rows="3"
            placeholder="<?php echo esc_attr__(
                'Write your message...',
                'pn-ai-agent'
            ); ?>"></textarea>

        <button
            id="pn-chat-send"
            class="button button-primary">

            <?php esc_html_e(
                'Send',
                'pn-ai-agent'
            ); ?>

        </button>

        <button
            id="pn-chat-clear"
            class="button">

            <?php esc_html_e(
                'Clear',
                'pn-ai-agent'
            ); ?>

        </button>

    </div>

</div>