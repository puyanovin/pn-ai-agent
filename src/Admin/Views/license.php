<?php

if (!defined('ABSPATH')) {
    exit;
}

$license = get_option('pn_ai_license_key', '');

?>

<div class="pn-license-card">

    <h2>
        <?php esc_html_e(
            'PN AI Agent Pro License',
            'pn-ai-agent'
        ); ?>
    </h2>

    <p class="description">

        <?php esc_html_e(
            'Enter your Pro license key to enable premium features and automatic updates.',
            'pn-ai-agent'
        ); ?>

    </p>

    <table class="form-table">

        <tr>

            <th>

                <?php esc_html_e(
                    'License Key',
                    'pn-ai-agent'
                ); ?>

            </th>

            <td>

                <input
                    type="text"
                    id="pn_ai_license_key"
                    value="<?php echo esc_attr($license); ?>"
                    class="regular-text"
                    placeholder="XXXX-XXXX-XXXX-XXXX">

                <p class="description">

                    <?php esc_html_e(
                        'Paste the license key received after purchase.',
                        'pn-ai-agent'
                    ); ?>

                </p>

            </td>

        </tr>

    </table>

    <p>

        <button
            id="pn-save-license"
            class="button button-primary">

            <?php esc_html_e(
                'Save License',
                'pn-ai-agent'
            ); ?>

        </button>

    </p>

</div>

<div class="pn-license-info">

    <h3>

        <?php esc_html_e(
            'PN AI Agent Pro',
            'pn-ai-agent'
        ); ?>

    </h3>

    <ul>

        <li>✅ Multi AI Providers</li>

        <li>✅ AI Agents</li>

        <li>✅ MCP Support</li>

        <li>✅ Knowledge Base</li>

        <li>✅ Image Generation</li>

        <li>✅ Memory</li>

        <li>✅ Premium Updates</li>

        <li>✅ Priority Support</li>

    </ul>

    <p>

        <a
            class="button button-secondary"
            target="_blank"
            href="https://plugins.puyanovin.ir/pn-ai-agent">

            <?php esc_html_e(
                'Buy Pro License',
                'pn-ai-agent'
            ); ?>

        </a>

    </p>

</div>