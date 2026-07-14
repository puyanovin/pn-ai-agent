<?php

declare(strict_types=1);

namespace PNAIAgent\Providers;

if (!defined('ABSPATH')) {
    exit;
}

final class LockedProvider implements ProviderInterface
{

    public function __construct(
        private readonly string $provider
    ) {}


    private function error(): array
    {
        return [
            'success' => false,
            'message' => sprintf(
                __('%s is available in PN AI Agent Pro.', 'pn-ai-agent'),
                ucfirst($this->provider)
            ),
        ];
    }


    public function supportsStreaming(): bool
    {
        return false;
    }


    public function testConnection(): array
    {
        return $this->error();
    }


    public function getModels(): array
    {
        return $this->error();
    }
    

    public function chat(string $prompt): array
    {
        return $this->error();
    }

}