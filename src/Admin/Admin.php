<?php

declare(strict_types=1);

namespace PNAIAgent\Admin;

if (!defined('ABSPATH')) {
    exit;
}

final class Admin
{
    public function register(): void
    {
        (new Menu())->register();
        (new Assets())->register();

        // بعداً
        // (new Settings())->register();
    }
}
