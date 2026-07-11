<?php
/**
 * Plugin Name:       PN AI Agent
 * Plugin URI:        https://plugins.puyanovin.ir/pn-ai-agent
 * Description:       Open-source AI Assistant for WordPress with support for OpenAI, Gemini, Claude, DeepSeek, Qwen and OpenAI-compatible APIs.
 * Version:           0.1.0
 * Requires at least: 6.5
 * Requires PHP:      8.1
 * Author:            PN Suite
 * Author URI:        https://plugins.puyanovin.ir
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       pn-ai-agent
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PN_AI_AGENT_VERSION', '0.1.0' );
define( 'PN_AI_AGENT_FILE', __FILE__ );
define( 'PN_AI_AGENT_PATH', plugin_dir_path( __FILE__ ) );
define( 'PN_AI_AGENT_URL', plugin_dir_url( __FILE__ ) );

require_once PN_AI_AGENT_PATH . 'vendor/autoload.php';
if (!class_exists(\PNAIAgent\Core\Application::class)) {
    wp_die('Application class not found');
}
use PNAIAgent\Core\Application;
use PNAIAgent\Core\Activator;
use PNAIAgent\Core\Deactivator;
use PNAIAgent\Frontend\ChatShortcode;
use PNAIAgent\Frontend\ChatWidget;

add_action('init', function () {
    (new ChatShortcode())->register();
});

add_action('widgets_init', function () {
    register_widget(ChatWidget::class);
});


add_action('init', function () {

    load_plugin_textdomain(
        'pn-ai-agent',
        false,
        dirname(plugin_basename(PN_AI_AGENT_FILE)) . '/languages'
    );

});

register_activation_hook(
    __FILE__,
    function () {
        \PNAIAgent\Database\Installer::install();
    }
);

register_deactivation_hook(
    __FILE__,
    [Deactivator::class, 'deactivate']
);

$app = new Application();
$app->run();

