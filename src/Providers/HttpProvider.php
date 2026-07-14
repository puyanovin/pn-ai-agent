<?php

declare(strict_types=1);

namespace PNAIAgent\Providers;

abstract class HttpProvider extends BaseProvider {

	protected function get(
		string $url,
		array $headers = array(),
		int $timeout = 30
	): array {

		$response = wp_remote_get(
			$url,
			array(
				'headers' => $headers,
				'timeout' => $timeout,
			)
		);

		return $this->parseResponse( $response );
	}

	protected function post(
		string $url,
		array $body,
		array $headers = array(),
		int $timeout = 60
	): array {

		$response = wp_remote_post(
			$url,
			array(
				'headers' => $headers,
				'body'    => wp_json_encode( $body ),
				'timeout' => $timeout,
			)
		);

		return $this->parseResponse( $response );
	}

	protected function parseResponse( array $response ): array {
		if ( is_wp_error( $response ) ) {
			return $this->error(
				$response->get_error_message()
			);
		}

		$code = wp_remote_retrieve_response_code( $response );

		$data = json_decode(
			wp_remote_retrieve_body( $response ),
			true
		);

		if ( $code < 200 || $code >= 300 ) {

			return $this->error(
				is_array( $data )
					? ( $data['error']['message']
						?? wp_remote_retrieve_body( $response ) )
					: wp_remote_retrieve_body( $response )
			);

		}

		return $this->success(
			array(
				'data' => is_array( $data )
					? $data
					: array(),
			)
		);
	}
}
