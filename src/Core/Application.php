<?php
declare(strict_types=1);

namespace PNAIAgent\Core;

use PNAIAgent\Admin\Admin;
use PNAIAgent\Blocks\ChatBlock;

if (!defined('ABSPATH')) {
    exit;
}

final class Application
{
    public function run(): void
    {
        (new Admin())->register();
        (new ChatBlock())->register();
    }
}