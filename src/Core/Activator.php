<?php

declare(strict_types=1);

namespace PNAIAgent\Core;

if (!defined('ABSPATH')) {
    exit;
}

final class Activator
{
    public static function activate(): void
    {
        if (get_option('pn_ai_agent_version') === false) {
            add_option('pn_ai_agent_version', PN_AI_AGENT_VERSION);
        }
    }
}
