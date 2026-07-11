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

<div class="card" style="max-width:900px;padding:20px">

<h2>

<?php
echo esc_html__(
    'General Settings',
    'pn-ai-agent'
);
?>

</h2>

<table class="form-table">

<tr>

<th>

<?php
echo esc_html__(
    'Provider',
    'pn-ai-agent'
);
?>

</th>

<td>

<select id="pn_ai_provider">

<?php foreach ($providers as $id => $name) : ?>

<option
value="<?php echo esc_attr($id); ?>"
<?php selected($currentProvider, $id); ?>>

<?php echo esc_html($name); ?>

</option>

<?php endforeach; ?>

</select>

</td>

</tr>

<tr>

<th>

<?php
echo esc_html__(
    'API URL',
    'pn-ai-agent'
);
?>

</th>

<td>

<input
type="text"
id="pn_ai_api_url"
class="regular-text"
value="<?php echo esc_attr($apiUrl); ?>">

</td>

</tr>

<tr>

<th>

<?php
echo esc_html__(
    'API Key',
    'pn-ai-agent'
);
?>

</th>

<td>

<input
type="password"
id="pn_ai_api_key"
class="regular-text"
value="<?php echo esc_attr($apiKey); ?>">

</td>

</tr>

<tr>

<th>

<?php
echo esc_html__(
    'Model',
    'pn-ai-agent'
);
?>

</th>

<td>

<select
id="pn_ai_model"
class="regular-text">

<?php if (!empty($model)) : ?>

<option
value="<?php echo esc_attr($model); ?>"
selected>

<?php echo esc_html($model); ?>

</option>

<?php else : ?>

<option value="">

<?php
echo esc_html__(
    '-- Load Models --',
    'pn-ai-agent'
);
?>

</option>

<?php endif; ?>

</select>

<button
class="button"
id="pn-load-models">

<?php
echo esc_html__(
    'Load Models',
    'pn-ai-agent'
);
?>

</button>

</td>

</tr>

</table>

<p>

<button
class="button pn-test-provider">

<?php
echo esc_html__(
    'Test Connection',
    'pn-ai-agent'
);
?>

</button>

<button
class="button button-primary"
id="pn-save-provider">

<?php esc_html_e('Save Settings', 'pn-ai-agent'); ?>

</button>

<div
id="pn-provider-status"
style="margin-top:15px;">
</div>

</p>

</div>