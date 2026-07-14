<?php
declare(strict_types=1);

namespace PNAIAgent\Core;

use PNAIAgent\Database\Installer;


if (!defined('ABSPATH')) {
    exit;
}

final class Activator
{
    public static function activate(): void
    {
        Installer::install();

        update_option('pn_ai_agent_version', PN_AI_AGENT_VERSION);

        flush_rewrite_rules();
    }
}


