<div class="pn-ai-chat">

    <h3>
        <?php echo esc_html($title); ?>
    </h3>


    <div 
        class="pn-chat-window"
        style="height:<?php echo esc_attr($height); ?>px;">

        <div class="pn-chat-messages"></div>

    </div>


    <textarea
        class="pn-chat-message"
        rows="3"
        placeholder="<?php echo esc_attr($placeholder); ?>">
    </textarea>


    <p>
        <button
            type="button"
            class="button button-primary pn-chat-send">

            <?php echo esc_html($button); ?>

        </button>

        <button
            type="button"
            class="button pn-chat-clear">

            <?php echo esc_html__('Clear', 'pn-ai-agent'); ?>

        </button>
    </p>

</div>