<?php

if (!defined('ABSPATH')) {
    exit;
}

$currentProvider = get_option('pn_ai_provider', 'openai');

$apiUrl = get_option(
    "pn_ai_{$currentProvider}_api_url",
    ''
);

$apiKey = get_option(
    "pn_ai_{$currentProvider}_api_key",
    ''
);

$model = get_option(
    "pn_ai_{$currentProvider}_model",
    ''
);

$providers = [
    'openai'     => 'OpenAI',
    'gemini'     => 'Google Gemini',
    'anthropic'  => 'Anthropic',
    'openrouter' => 'OpenRouter',
    'ollama'     => 'Ollama',
];

?>

<div class="wrap">

    <h1><?php esc_html_e('Providers', 'pn-ai-agent'); ?></h1>

    <table class="widefat striped">

        <thead>
            <tr>
                <th><?php esc_html_e('Provider', 'pn-ai-agent'); ?></th>
                <th><?php esc_html_e('Status', 'pn-ai-agent'); ?></th>
                <th width="180"><?php esc_html_e('Action', 'pn-ai-agent'); ?></th>
                <th><?php esc_html_e('Result', 'pn-ai-agent'); ?></th>
            </tr>
        </thead>

        <tbody>

        <?php foreach ($providers as $id => $name) : ?>

            <tr>

                <td><?php echo esc_html($name); ?></td>

                <td>

                    <?php if ($currentProvider === $id) : ?>

                        <span style="color:green;font-weight:bold;">
                            <?php esc_html_e('Active', 'pn-ai-agent'); ?>
                        </span>

                    <?php else : ?>

                        <span style="color:#777;">
                            I<?php esc_html_e('Inactive', 'pn-ai-agent'); ?>
                        </span>

                    <?php endif; ?>

                </td>

                <td>

                    <button
                        class="button button-primary pn-test-provider"
                        data-provider="<?php echo esc_attr($id); ?>">
                        <?php esc_html_e('Test Connection', 'pn-ai-agent'); ?>
                    </button>

                </td>
                <td>

                <span
                    id="pn-result-<?php echo esc_attr($id); ?>">
                -
                </span>

                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>