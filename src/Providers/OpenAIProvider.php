<?php

declare(strict_types=1);

namespace PNAIAgent\Providers;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class OpenAIProvider extends HttpProvider {

	protected string $provider = 'openai';

	public function testConnection(): array {

		$config = $this->config();

		$apiKey = $config['api_key'];
		$model  = $config['model'];
		$apiUrl = $config['api_url'];

		if ( empty( $apiKey ) ) {
			return $this->error(
				__( 'API Key is empty.', 'pn-ai-agent' )
			);
		}

		$response = wp_remote_post(
			trailingslashit( $apiUrl ) . 'responses',
			array(
				'timeout' => 30,
				'headers' => array(
					'Authorization' => 'Bearer ' . $apiKey,
					'Content-Type'  => 'application/json',
				),
				'body'    => wp_json_encode(
					array(
						'model' => $model,
						'input' => 'Reply with only: OK',
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

		return $this->success(
			array(
				'message' => __( 'Connection successful.', 'pn-ai-agent' ),
			)
		);
	}

	public function getModels(): array {
		$config = $this->config();

		$apiKey = $config['api_key'];
		$apiUrl = $config['api_url'];

		if ( $apiKey === '' ) {
			return $this->error(
				__( 'API Key is empty.', 'pn-ai-agent' )
			);
		}

		$response = wp_remote_get(
			trailingslashit( $apiUrl ) . 'models',
			array(
				'timeout' => 30,
				'headers' => array(
					'Authorization' => 'Bearer ' . $apiKey,
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

		return $this->success(
			array(
				'models' => $data['data'] ?? array(),
			)
		);
	}

	public function chat( string $prompt ): array {

		if ( trim( $prompt ) === '' ) {

			return $this->error(
				__( 'Prompt is empty.', 'pn-ai-agent' )
			);
		}

		$config = $this->config();

		$apiKey = $config['api_key'];
		$model  = $config['model'];
		$apiUrl = $config['api_url'];

		if ( $apiKey === '' ) {
			return $this->error(
				__( 'API Key is empty.', 'pn-ai-agent' )
			);
		}

		$response = wp_remote_post(
			trailingslashit( $apiUrl ) . 'chat/completions',
			array(
				'headers' => array(
					'Authorization' => 'Bearer ' . $apiKey,
					'Content-Type'  => 'application/json',
				),
				'body'    => wp_json_encode(
					array(
						'model'    => $model,
						'messages' => array(
							array(
								'role'    => 'user',
								'content' => $prompt,
							),
						),
					)
				),
				'timeout' => 60,
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

		if ( isset( $data['error'] ) ) {
			return $this->error(
				$data['error']['message']
				?? __( 'Unknown provider error.', 'pn-ai-agent' )
			);
		}

		$answer = $data['choices'][0]['message']['content'] ?? '';

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
