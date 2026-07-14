<?php

declare(strict_types=1);

namespace PNAIAgent\Frontend;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class ChatShortcode {

	public function register(): void {
		add_shortcode(
			'pn_ai_chat',
			array( $this, 'render' )
		);
	}

	public function render( array $atts = array() ): string {
		$atts = shortcode_atts(
			array(
				'title'       => __( 'AI Assistant', 'pn-ai-agent' ),
				'height'      => '500',
				'placeholder' => __( 'Write your message...', 'pn-ai-agent' ),
				'button'      => __( 'Send', 'pn-ai-agent' ),
			),
			$atts,
			'pn_ai_chat'
		);

		$title       = sanitize_text_field( $atts['title'] );
		$height      = max( 200, min( 1000, (int) $atts['height'] ) );
		$placeholder = sanitize_text_field( $atts['placeholder'] );
		$button      = sanitize_text_field( $atts['button'] );

		ob_start();

		include PN_AI_AGENT_PATH . 'src/Frontend/chat-template.php';

		return ob_get_clean();
	}
}
