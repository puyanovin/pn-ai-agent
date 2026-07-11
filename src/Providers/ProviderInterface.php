<?php

declare(strict_types=1);

namespace PNAIAgent\Providers;

interface ProviderInterface
{
    public function testConnection(): array;
}
