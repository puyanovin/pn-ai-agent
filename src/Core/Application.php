<?php
declare(strict_types=1);

namespace PNAIAgent\Core;

use PNAIAgent\Admin\Admin;

if (!defined('ABSPATH')) {
    exit;
}

final class Application
{
    public function run(): void
    {
        (new Admin())->register();
    }
}