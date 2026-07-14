<?php

declare(strict_types=1);

namespace PNAIAgent\Providers;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class GeminiProvider extends BaseProvider {

	protected string $provider = 'gemini';

	public function testConnection(): array {
		$config = $this->config();

		if ( $config['api_key'] === '' ) {
			return $this->error(
				__( 'API Key is empty.', 'pn-ai-agent' )
			);
		}

		return $this->chat( 'Reply with only: OK' );
	}

	public function getModels(): array {
		$config = $this->config();

		if ( $config['api_key'] === '' ) {
			return $this->error(
				__( 'API Key is empty.', 'pn-ai-agent' )
			);
		}

		$response = wp_remote_get(
			trailingslashit( $config['api_url'] ) .
			'models?key=' .
			rawurlencode( $config['api_key'] ),
			array(
				'timeout' => 30,
			)
		);

		if ( is_wp_error( $response ) ) {
			return $this->wpError( $response );
		}

		$error = $this->responseError( $response );

		if ( $error !== null ) {
			return $error;
		}

		$data = $this->decode( $response );

		return $this->success(
			array(
				'models' => $data['models'] ?? array(),
			)
		);
	}

	public function chat( string $prompt ): array {
		$config = $this->config();

		if ( $config['api_key'] === '' ) {
			return $this->error(
				__( 'API Key is empty.', 'pn-ai-agent' )
			);
		}

		$url =
			trailingslashit( $config['api_url'] ) .
			'models/' .
			$config['model'] .
			':generateContent?key=' .
			rawurlencode( $config['api_key'] );

		$response = wp_remote_post(
			$url,
			array(
				'timeout' => 60,

				'headers' => array(
					'Content-Type' => 'application/json',
				),

				'body'    => wp_json_encode(
					array(
						'contents' => array(
							array(
								'parts' => array(
									array(
										'text' => $prompt,
									),
								),
							),
						),
					)
				),
			)
		);

		if ( is_wp_error( $response ) ) {
			return $this->wpError( $response );
		}

		$error = $this->responseError( $response );

		if ( $error !== null ) {
			return $error;
		}

		$data = $this->decode( $response );

		$answer =
			$data['candidates'][0]['content']['parts'][0]['text']
			?? '';

		if ( $answer === '' ) {
			return $this->error(
				__( 'Empty response from provider.', 'pn-ai-agent' )
			);
		}

		return $this->success(
			array(
				'message' => $answer,
			)
		);
	}
}
