<?php

if (!defined('ABSPATH')) {
   exit;
}

$currentProvider = get_option('pn_ai_provider', 'openai');

$providers = [

    'openai' => [
        'title' => __('OpenAI', 'pn-ai-agent'),
        'free'  => true,
    ],

    'gemini' => [
        'title' => __('Google Gemini', 'pn-ai-agent'),
        'free'  => true,
    ],

    'ollama' => [
        'title' => __('Ollama (Local)', 'pn-ai-agent'),
        'free'  => true,
    ],

    'anthropic' => [
        'title' => __('Anthropic Claude', 'pn-ai-agent'),
        'free'  => false,
    ],

    'openrouter' => [
        'title' => __('OpenRouter', 'pn-ai-agent'),
        'free'  => false,
    ],

];

?>

<div class="wrap">

    <h1><?php esc_html_e('AI Providers', 'pn-ai-agent'); ?></h1>

    <p class="description">

        <?php esc_html_e(
            'Manage and test the AI providers available to PN AI Agent.',
            'pn-ai-agent'
        ); ?>

    </p>

    <table class="widefat striped">

        <thead>

        <tr>

            <th><?php esc_html_e('Provider', 'pn-ai-agent'); ?></th>

            <th width="120">
                <?php esc_html_e('Edition', 'pn-ai-agent'); ?>
            </th>

            <th width="120">
                <?php esc_html_e('Status', 'pn-ai-agent'); ?>
            </th>

            <th width="180">
                <?php esc_html_e('Action', 'pn-ai-agent'); ?>
            </th>

            <th>
                <?php esc_html_e('Result', 'pn-ai-agent'); ?>
            </th>

        </tr>

        </thead>

        <tbody>

        <?php foreach ($providers as $id => $provider) : ?>

            <?php
            $isFree = $provider['free'];
            $isActive = ($currentProvider === $id);
            ?>

            <tr>

                <td>

                    <strong><?php echo esc_html($provider['title']); ?></strong>

                    <?php if (!$isFree) : ?>

                        <span class="pn-pro-badge">
                            <?php esc_html_e('PRO', 'pn-ai-agent'); ?>
                        </span>

                    <?php endif; ?>

                </td>

                <td>

                    <?php echo $isFree
                        ? esc_html__('Free', 'pn-ai-agent')
                        : esc_html__('Pro', 'pn-ai-agent'); ?>

                </td>

                <td>

                    <?php if ($isActive) : ?>

                        <span style="color:#008a20;font-weight:600">

                            <?php esc_html_e('Active', 'pn-ai-agent'); ?>

                        </span>

                    <?php else : ?>

                        <span style="color:#666">

                            <?php esc_html_e('Inactive', 'pn-ai-agent'); ?>

                        </span>

                    <?php endif; ?>

                </td>

                <td>

                    <?php if ($isFree) : ?>

                        <button
                            class="button button-secondary pn-test-provider"
                            data-provider="<?php echo esc_attr($id); ?>">

                            <?php esc_html_e(
                                'Test Connection',
                                'pn-ai-agent'
                            ); ?>

                        </button>

                    <?php else : ?>

                        <button
                            class="button"
                            disabled>

                            <?php esc_html_e(
                                'Pro Only',
                                'pn-ai-agent'
                            ); ?>

                        </button>

                    <?php endif; ?>

                </td>

                <td>

                    <?php if ($isFree) : ?>

                        <span id="pn-result-<?php echo esc_attr($id); ?>">
                            —
                        </span>

                    <?php else : ?>

                        <span style="color:#996800">

                            <?php esc_html_e(
                                'Available in PN AI Agent Pro.',
                                'pn-ai-agent'
                            ); ?>

                        </span>

                    <?php endif; ?>

                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>