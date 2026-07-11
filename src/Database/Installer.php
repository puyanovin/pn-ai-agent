<?php

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

        dbDelta("
        CREATE TABLE {$table} (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            role VARCHAR(20),
            message LONGTEXT,
            created_at DATETIME,
            PRIMARY KEY(id)
        ) {$charset};
        ");
    }
}
