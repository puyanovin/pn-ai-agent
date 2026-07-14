<?php

declare(strict_types=1);

namespace PNAIAgent\Providers;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class BaseProvider implements ProviderInterface {

	protected string $provider;


	protected function config(): array {
		return array(
			'provider' => $this->provider,

			'api_key'  => get_option(
				"pn_ai_{$this->provider}_api_key",
				''
			),

			'api_url'  => esc_url_raw(
				get_option(
					"pn_ai_{$this->provider}_api_url",
					ProviderFactory::defaultUrl( $this->provider )
				)
			),

			'model'    => get_option(
				"pn_ai_{$this->provider}_model",
				ProviderFactory::defaultModel( $this->provider )
			),
		);
	}


	protected function error( string $message ): array {
		return array(
			'success' => false,
			'message' => $message,
		);
	}



	protected function success( array $data = array() ): array {
		return array(
			'success' => true,
			'data'    => $data,
		);
	}


	protected function wpError( \WP_Error $error ): array {
		return $this->error(
			$error->get_error_message()
		);
	}


	protected function responseError( array $response ): ?array {
		$code = wp_remote_retrieve_response_code( $response );

		if ( $code >= 200 && $code < 300 ) {
			return null;
		}

		$body = wp_remote_retrieve_body( $response );

		if ( $body === '' ) {
			$body = __( 'Unknown provider error.', 'pn-ai-agent' );
		}

		$data = json_decode( $body, true );

		return $this->error(
			$data['error']['message'] ?? $body
		);
	}


	protected function decode( array $response ): array {
		$data = json_decode(
			wp_remote_retrieve_body( $response ),
			true
		);

		return is_array( $data )
			? $data
			: array();
	}

	public function supportsStreaming(): bool {
		return false;
	}
}
