<?php

declare(strict_types=1);

namespace PNAIAgent\Database;

if (!defined('ABSPATH')) {
    exit;
}

final class Installer
{
    public static function install(): void
    {
        global $wpdb;

        $table = $wpdb->prefix . 'pn_ai_chat_history';

        $charset = $wpdb->get_charset_collate();

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $sql = "
        CREATE TABLE {$table} (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            role VARCHAR(20) NOT NULL,
            message LONGTEXT NOT NULL,
            created_at DATETIME NOT NULL,
            PRIMARY KEY (id),
            KEY created_at (created_at)
        ) ENGINE=InnoDB {$charset};
        ";

        dbDelta($sql);

        update_option('pn_ai_agent_db_version', '1.0.0');
    }
}
