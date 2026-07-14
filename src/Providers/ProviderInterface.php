<?php

declare(strict_types=1);

namespace PNAIAgent\Providers;

interface ProviderInterface
{
    public function testConnection(): array;

    public function getModels(): array;

    public function chat(string $prompt): array;

    public function supportsStreaming(): bool;
}