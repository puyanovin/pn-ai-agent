<?php

declare(strict_types=1);

namespace PNAIAgent\Providers;

if (!defined('ABSPATH')) {
    exit;
}

final class OpenAIProvider extends HttpProvider
{
    protected string $provider = 'openai';

    public function testConnection(): array
    {

        $config = $this->config();

        $apiKey = $config['api_key'];
        $model  = $config['model'];
        $apiUrl = $config['api_url'];

        if (empty($apiKey)) {
            return $this->error(
                __('API Key is empty.', 'pn-ai-agent')
            );
        }

        $response = wp_remote_post(
            trailingslashit($apiUrl) . 'responses',
            [
                'timeout' => 30,
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type'  => 'application/json',
                ],
                'body' => wp_json_encode([
                    'model' => $model,
                    'input' => 'Reply with only: OK',
                ]),
            ]
        );

        if (is_wp_error($response)) {
            return $this->wpError($response);
        }

        $error = $this->responseError($response);

        if ($error !== null) {
            return $error;
        }

        return $this->success([
            'message' => __('Connection successful.', 'pn-ai-agent'),
        ]);

    }

    public function getModels(): array
    {
        $config = $this->config();

        $apiKey = $config['api_key'];
        $apiUrl = $config['api_url'];

        if ($apiKey === '') {
            throw new \Exception(
                __('API Key is empty.', 'pn-ai-agent')
            );
        }

        $response = wp_remote_get(
            trailingslashit($apiUrl) . 'models',
            [
                'timeout' => 30,
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                ],
            ]
        );


        if (is_wp_error($response)) {
            throw new \Exception(
                $response->get_error_message()
            );
        }


        $error = $this->responseError($response);

        if ($error !== null) {
            throw new \Exception(
                $error['data']['message'] ?? 'OpenAI error'
            );
        }


        $data = $this->decode($response);
        error_log('[PN AI DEBUG] OpenAI Response: ' . print_r($data, true));


        return $data['data'] ?? [];
    }

    public function chat(string $prompt): array
    {

        if (trim($prompt) === '') {
            
            return $this->error(
                __('Prompt is empty.', 'pn-ai-agent')
            );
        }
        
        $config = $this->config();

        $apiKey = $config['api_key'];
        $model  = $config['model'];
        $apiUrl = $config['api_url'];

        if ($apiKey === '') {
            return $this->error(
                __('API Key is empty.', 'pn-ai-agent')
            );
        }

        $response = wp_remote_post(
            trailingslashit($apiUrl) . 'chat/completions',
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type'  => 'application/json',
                ],
                'body' => wp_json_encode([
                    'model' => $model,
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $prompt,
                        ],
                    ],
                ]),
                'timeout' => 60,
            ]
        );

        if (is_wp_error($response)) {
            return $this->wpError($response);
        }
        
        $error = $this->responseError($response);

        if ($error !== null) {
            return $error;
        }

        $data = $this->decode($response);

        if (isset($data['error'])) {
            return $this->error(
                $data['error']['message']
                ?? __('Unknown provider error.', 'pn-ai-agent')
            );
        }

        $answer = $data['choices'][0]['message']['content'] ?? '';

        error_log(print_r($answer, true));

        if ($answer === '') {
            return $this->error(
                __('Empty response from provider.', 'pn-ai-agent')
            );
        }

        error_log('ANSWER = ' . $answer);

        return $this->success([
            'message' => $answer,
        ]);

        error_log(print_r($result, true));

        return $result;

    }

}