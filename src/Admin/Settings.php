<?php

declare(strict_types=1);

namespace PNAIAgent\Admin;

use PNAIAgent\Providers\ProviderFactory;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Settings {

	public function register(): void {
		add_action( 'admin_init', array( $this, 'registerSettings' ) );
	}

	public function registerSettings(): void {
		register_setting(
			'pn_ai_agent_general',
			'pn_ai_provider',
			array(
				'type'              => 'string',
				'sanitize_callback' => static function ( $value ) {

					$value = sanitize_key( wp_unslash( $value ) );

					return in_array(
						$value,
						ProviderFactory::ALLOWED_PROVIDERS,
						true
					)
						? $value
						: 'openai';
				},
				'default'           => 'openai',
			)
		);

		$providers = defined( 'PN_AI_AGENT_PRO' )
			? ProviderFactory::ALLOWED_PROVIDERS
			: ProviderFactory::FREE_PROVIDERS;

		foreach ( $providers as $provider ) {

			register_setting(
				'pn_ai_agent_general',
				"pn_ai_{$provider}_api_key",
				array(
					'type'              => 'string',
					'sanitize_callback' => static function ( $value ) {

						return sanitize_text_field(
							wp_unslash( $value )
						);
					},
				)
			);

			register_setting(
				'pn_ai_agent_general',
				"pn_ai_{$provider}_api_url",
				array(
					'type'              => 'string',
					'sanitize_callback' => 'esc_url_raw',
				)
			);

			register_setting(
				'pn_ai_agent_general',
				"pn_ai_{$provider}_model",
				array(
					'type'              => 'string',
					'sanitize_callback' => static function ( $value ) {

						return sanitize_text_field(
							wp_unslash( $value )
						);
					},
				)
			);
		}
	}
}
