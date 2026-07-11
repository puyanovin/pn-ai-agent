<?php

declare(strict_types=1);

namespace PNAIAgent\Providers;

if (!defined('ABSPATH')) exit;

final class ProviderFactory
{
    public static function make()
    {
        return new OpenAIProvider();
    }
}