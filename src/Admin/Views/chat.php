<?php

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


$currentProvider = get_option(
	'pn_ai_provider',
	'openai'
);


$currentModel = get_option(
	'pn_ai_' . $currentProvider . '_model',
	__( 'Not configured', 'pn-ai-agent' )
);

?>

<div class="pn-chat">


	<div class="pn-chat-header">

		<h2>
			<?php
			esc_html_e(
				'AI Playground',
				'pn-ai-agent'
			);
			?>
		</h2>


		<p class="description">

			<?php
			esc_html_e(
				'Test your configured AI provider and interact with your AI assistant.',
				'pn-ai-agent'
			);
			?>

		</p>

	</div>


	<div class="pn-chat-info">

		<span>
			<?php
			esc_html_e(
				'Provider:',
				'pn-ai-agent'
			);
			?>

			<strong>
				<?php echo esc_html( $currentProvider ); ?>
			</strong>

		</span>


		<span>
			<?php
			esc_html_e(
				'Model:',
				'pn-ai-agent'
			);
			?>

			<strong>
				<?php echo esc_html( $currentModel ); ?>
			</strong>

		</span>

	</div>



	<div
		id="pn-chat-window"
		class="pn-chat-window">
	</div>



	<div class="pn-chat-input">


		<textarea
			id="pn-chat-message"
			rows="2"
			placeholder="
			<?php
			echo esc_attr__(
				'Type your message here...',
				'pn-ai-agent'
			);
			?>
			"></textarea>



		<div class="pn-chat-buttons">


			<button
				id="pn-chat-send"
				class="button button-primary">

				💬

				<?php
				esc_html_e(
					'Send',
					'pn-ai-agent'
				);
				?>

			</button>



			<button
				id="pn-chat-clear"
				class="button">

				🗑

				<?php
				esc_html_e(
					'Clear',
					'pn-ai-agent'
				);
				?>

			</button>


		</div>


	</div>


</div>