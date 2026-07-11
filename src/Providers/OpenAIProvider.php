<?php

declare(strict_types=1);

namespace PNAIAgent\Providers;

if (!defined('ABSPATH')) {
    exit;
}

final class OpenAIProvider implements ProviderInterface
{
    public function testConnection(): array
    {
        $apiKey = get_option('pn_ai_api_key', '');
        $model  = get_option('pn_ai_model', 'gpt-4.1-mini');
        $url    = get_option('pn_ai_api_url', 'https://api.openai.com/v1');

        if (empty($apiKey)) {
            return [
                'success' => false,
                'message' => 'API Key is empty.',
            ];
        }



        $response = wp_remote_post(
            trailingslashit($url) . 'responses',
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
            return [
                'success' => false,
                'message' => $response->get_error_message(),
            ];
        }

        $code = wp_remote_retrieve_response_code($response);

        if ($code !== 200) {
            return [
                'success' => false,
                'message' => wp_remote_retrieve_body($response),
            ];
        }

        return [
            'success' => true,
            'message' => 'Connection successful.',
        ];
    }

    public function getModels(): array
    {
        $apiKey = get_option('pn_ai_api_key', '');
        $url = get_option(
            'pn_ai_api_url',
            'https://api.openai.com/v1'
        );

        $response = wp_remote_get(
            trailingslashit($url) . 'models',
            [
                'timeout' => 30,
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                ],
            ]
        );

        if (is_wp_error($response)) {
            return [
                'success' => false,
                'message' => $response->get_error_message(),
            ];
        }

        $code = wp_remote_retrieve_response_code($response);

        if ($code !== 200) {
            return [
                'success' => false,
                'message' => wp_remote_retrieve_body($response),
            ];
        }


        $data = json_decode(
            wp_remote_retrieve_body($response),
            true
        );

        return [
            'success' => true,
            'message' =>
                $data['choices'][0]['message']['content'] ?? ''
        ];

        update_option(
            'pn_ai_openai_models',
            $models['data'],
            false
        );

        return [
            'success' => true,
            'models' => $models['data'],
        ];
    }

    public function chat(string $prompt): array
    {
        $provider = get_option('pn_ai_provider', 'openai');

        $apiKey = get_option(
            "pn_ai_{$provider}_api_key",
            ''
        );

        $apiUrl = get_option(
            "pn_ai_{$provider}_api_url",
            'https://api.openai.com/v1'
        );

        $model = get_option(
            "pn_ai_{$provider}_model",
            'gpt-4o-mini'
        );

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
            return [
                'success' => false,
                'message' => $response->get_error_message(),
            ];
        }

        $data = json_decode(
            wp_remote_retrieve_body($response),
            true
        );

        if (isset($data['error'])) {
            return [
                'success' => false,
                'message' => $data['error']['message'],
            ];
        }

        global $wpdb;

        $answer = $data['choices'][0]['message']['content'] ?? '';


        $table = $wpdb->prefix . 'pn_ai_chat_history';

        $wpdb->insert(
            $table,
            [
                'role'       => 'user',
                'message'    => $prompt,
                'created_at' => current_time('mysql'),
            ]
        );

        $wpdb->insert(
            $table,
            [
                'role'       => 'assistant',
                'message'    => $answer,
                'created_at' => current_time('mysql'),
            ]
        );

        return [
            'success' => true,
            'message' => $answer,
        ];
    }
}