<?php
/**
 * Plugin Name:       PN AI Agent
 * Plugin URI:        https://plugins.puyanovin.ir//pn-ai-agent
 * Description:       Open-source AI Agent platform for WordPress.
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
use PNAIAgent\Core\Application;

$app = new Application();
$app->run();

