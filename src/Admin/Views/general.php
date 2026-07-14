<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$currentProvider = get_option( 'pn_ai_provider', 'openai' );

$providers = array(

	'openai'     => array(
		'label' => __( 'OpenAI', 'pn-ai-agent' ),
		'free'  => true,
	),

	'gemini'     => array(
		'label' => __( 'Google Gemini', 'pn-ai-agent' ),
		'free'  => true,
	),

	'ollama'     => array(
		'label' => __( 'Ollama (Local)', 'pn-ai-agent' ),
		'free'  => true,
	),

	'anthropic'  => array(
		'label' => __( 'Anthropic Claude', 'pn-ai-agent' ),
		'free'  => false,
	),

	'openrouter' => array(
		'label' => __( 'OpenRouter', 'pn-ai-agent' ),
		'free'  => false,
	),

);

$apiUrl = get_option(
	"pn_ai_{$currentProvider}_api_url",
	\PNAIAgent\Providers\ProviderFactory::defaultUrl( $currentProvider )
);
$apiKey = get_option( "pn_ai_{$currentProvider}_api_key", '' );

$model = get_option(
	"pn_ai_{$currentProvider}_model",
	\PNAIAgent\Providers\ProviderFactory::defaultModel( $currentProvider )
);

?>

<div class="card" style="max-width:900px;">

	<h2><?php esc_html_e( 'General Settings', 'pn-ai-agent' ); ?></h2>

	<p class="description">

		<?php
		esc_html_e(
			'Configure the default AI provider and connection settings.',
			'pn-ai-agent'
		);
		?>

	</p>

	<table class="form-table" role="presentation">

		<tbody>

		<tr>

			<th scope="row">

				<label for="pn_ai_provider">

					<?php esc_html_e( 'AI Provider', 'pn-ai-agent' ); ?>

				</label>

			</th>

			<td>

				<select id="pn_ai_provider" name="pn_ai_provider">

					<?php foreach ( $providers as $id => $provider ) : ?>

						<option
							value="<?php echo esc_attr( $id ); ?>"
							<?php selected( $currentProvider, $id ); ?>>

							<?php
							echo esc_html( $provider['label'] );

							if ( ! $provider['free'] ) {
								echo ' (PRO)';
							}
							?>

						</option>

					<?php endforeach; ?>

				</select>

				<p class="description">

					<?php
					esc_html_e(
						'Choose the AI provider used by the plugin.',
						'pn-ai-agent'
					);
					?>

				</p>

			</td>

		</tr>

		<tr>

			<th scope="row">

				<label for="pn_ai_api_url">

					<?php esc_html_e( 'API Endpoint', 'pn-ai-agent' ); ?>

				</label>

			</th>

			<td>

				<input
					id="pn_ai_api_url"
					type="url"
					class="regular-text"
					value="<?php echo esc_attr( $apiUrl ); ?>">

			</td>

		</tr>

		<tr>

			<th scope="row">

				<label for="pn_ai_api_key">

					<?php esc_html_e( 'API Key', 'pn-ai-agent' ); ?>

				</label>

			</th>

			<td>

				<input
					id="pn_ai_api_key"
					type="password"
					class="regular-text"
					autocomplete="off"
					value="<?php echo esc_attr( $apiKey ); ?>">

			</td>

		</tr>

		<tr>

			<th scope="row">

				<label for="pn_ai_model">

					<?php esc_html_e( 'Default Model', 'pn-ai-agent' ); ?>

				</label>

			</th>

			<td>

				<select
					id="pn_ai_model"
					name="pn_ai_model"
					class="regular-text">

					<?php if ( $model ) : ?>

						<option
							value="<?php echo esc_attr( $model ); ?>"
							selected>

							<?php echo esc_html( $model ); ?>

						</option>

					<?php else : ?>

						<option value="">

							<?php
							esc_html_e(
								'Select a model...',
								'pn-ai-agent'
							);
							?>

						</option>

					<?php endif; ?>

				</select>

				<button
					type="button"
					class="button"
					id="pn-load-models">

					<?php
					esc_html_e(
						'Load Models',
						'pn-ai-agent'
					);
					?>

				</button>

			</td>

		</tr>

		</tbody>

	</table>

	<p>

		<button
			type="button"
			class="button pn-test-provider"
			id="pn-test-provider">

			<?php
			esc_html_e(
				'Test Connection',
				'pn-ai-agent'
			);
			?>

		</button>

		<button
			type="button"
			class="button button-primary"
			id="pn-save-provider">

			<?php
			esc_html_e(
				'Save Settings',
				'pn-ai-agent'
			);
			?>

		</button>

	</p>

	<div id="pn-provider-status"></div>

</div>