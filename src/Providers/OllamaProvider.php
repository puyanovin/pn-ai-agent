<?php

declare(strict_types=1);

namespace PNAIAgent\Providers;

if (!defined('ABSPATH')) {
    exit;
}

final class OllamaProvider extends BaseProvider
{
    protected string $provider = 'ollama';

    public function testConnection(): array
    {
        $config = $this->config();

        $response = wp_remote_get(
            trailingslashit($config['api_url']) . 'tags',
            [
                'timeout' => 15,
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

        $response = wp_remote_get(
            trailingslashit($config['api_url']) . 'tags',
            [
                'timeout' => 30,
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

        $models = [];

        foreach ($data['models'] ?? [] as $model) {

            $models[] = [
                'id' => $model['name'],
            ];

        }

        return $this->success([
            'models' => $models,
        ]);
    }

    public function chat(string $prompt): array
    {
        if (trim($prompt) === '') {
            return $this->error(
                __('Prompt is empty.', 'pn-ai-agent')
            );
        }

        $config = $this->config();

        $response = wp_remote_post(
            trailingslashit($config['api_url']) . 'chat',
            [
                'timeout' => 300,

                'headers' => [
                    'Content-Type' => 'application/json',
                ],

                'body' => wp_json_encode([
                    'model' => $config['model'],
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $prompt,
                        ],
                    ],
                    'stream' => false,
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

        $data = $this->decode($response);

        $answer = $data['message']['content'] ?? '';

        if ($answer === '') {
            return $this->error(
                __('Empty response from provider.', 'pn-ai-agent')
            );
        }

        return $this->success([
            'message' => $answer,
        ]);
    }
}