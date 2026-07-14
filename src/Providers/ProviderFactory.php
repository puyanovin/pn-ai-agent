<?php

declare(strict_types=1);

namespace PNAIAgent\Providers;

if (!defined('ABSPATH')) {
    exit;
}

final class ProviderFactory
{
    public const ALLOWED_PROVIDERS = [
        'openai',
        'gemini',
        'anthropic',
        'openrouter',
        'ollama',
    ];

    public const FREE_PROVIDERS = [
        'openai',
        'gemini',
        'ollama',
    ];

    public static function make(?string $provider = null): ProviderInterface
    {
        $provider ??= sanitize_key(
            get_option('pn_ai_provider', 'openai')
        );

        if (!in_array(
            $provider,
            self::ALLOWED_PROVIDERS,
            true
        )) {
            $provider = 'openai';
        }

        if (
            !in_array(
                $provider,
                self::FREE_PROVIDERS,
                true
            )
        ) {
            return new LockedProvider($provider);
        }

        return match ($provider) {

            'openai' => new OpenAIProvider(),

            'gemini' => new GeminiProvider(),

            'ollama' => new OllamaProvider(),

            default => new LockedProvider($provider),

        };
    }

    public static function defaultUrl(string $provider): string
    {
        return match ($provider) {

            'openai'
                => 'https://api.openai.com/v1',

            'gemini'
                => 'https://generativelanguage.googleapis.com/v1beta',

            'anthropic'
                => 'https://api.anthropic.com/v1',

            'openrouter'
                => 'https://openrouter.ai/api/v1',

            'ollama'
                => 'http://localhost:11434/api',

            default
                => '',
        };
    }

    public static function defaultModel(string $provider): string
    {
        return match ($provider) {

            'openai'
                => 'gpt-5-mini',

            'gemini'
                => 'gemini-2.5-flash',

            'anthropic'
                => 'claude-sonnet-4-0',

            'openrouter'
                => 'openai/gpt-4.1-mini',

            'ollama'
                => 'llama3.2',

            default
                => '',
        };
    }

    public static function isFree(string $provider): bool
    {
        return in_array($provider, self::FREE_PROVIDERS, true);
    }
}