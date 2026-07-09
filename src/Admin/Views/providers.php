<?php

if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="wrap">
    <h1><?php esc_html_e('Providers', 'pn-ai-agent'); ?></h1>

    <form method="post" action="options.php">

        <?php
        settings_fields('pn_ai_agent_general');
        do_settings_sections('pn_ai_agent_general');
        ?>

        <table class="form-table">

            <tr>
                <th>
                    <label for="pn_ai_provider">
                        <?php esc_html_e('Provider', 'pn-ai-agent'); ?>
                    </label>
                </th>
                <td>
                    <select id="pn_ai_provider" name="pn_ai_provider">

                        <option value="openai"
                            <?php selected(get_option('pn_ai_provider', 'openai'), 'openai'); ?>>
                            OpenAI
                        </option>

                        <option value="gemini"
                            <?php selected(get_option('pn_ai_provider'), 'gemini'); ?>>
                            Gemini
                        </option>

                        <option value="anthropic"
                            <?php selected(get_option('pn_ai_provider'), 'anthropic'); ?>>
                            Anthropic (Claude)
                        </option>

                        <option value="ollama"
                            <?php selected(get_option('pn_ai_provider'), 'ollama'); ?>>
                            Ollama
                        </option>

                        <option value="openrouter"
                            <?php selected(get_option('pn_ai_provider'), 'openrouter'); ?>>
                            OpenRouter
                        </option>

                    </select>
                </td>
            </tr>

            <tr>
                <th>
                    <label for="pn_ai_api_key">
                        <?php esc_html_e('API Key', 'pn-ai-agent'); ?>
                    </label>
                </th>

                <td>
                    <input
                        class="regular-text"
                        type="password"
                        id="pn_ai_api_key"
                        name="pn_ai_api_key"
                        value="<?php echo esc_attr(get_option('pn_ai_api_key')); ?>">
                </td>
            </tr>

            <tr>
                <th>
                    <label for="pn_ai_api_url">
                        <?php esc_html_e('API URL', 'pn-ai-agent'); ?>
                    </label>
                </th>

                <td>
                    <input
                        class="regular-text"
                        type="url"
                        id="pn_ai_api_url"
                        name="pn_ai_api_url"
                        value="<?php echo esc_attr(get_option('pn_ai_api_url')); ?>">
                </td>
            </tr>

            <tr>
                <th>
                    <label for="pn_ai_model">
                        <?php esc_html_e('Model', 'pn-ai-agent'); ?>
                    </label>
                </th>

                <td>
                    <input
                        class="regular-text"
                        type="text"
                        id="pn_ai_model"
                        name="pn_ai_model"
                        value="<?php echo esc_attr(get_option('pn_ai_model')); ?>">
                </td>
            </tr>

        </table>
        <?php submit_button(); ?>

    </form>

</div>
