<?php
/**
 * Plugin Name:       PN AI Agent
 * Plugin URI:        https://plugins.puyanovin.ir/pn-ai-agent
 * Description:       AI assistant for WordPress supporting OpenAI, Gemini, and Ollama.
 * Version:           1.0.1
 * Requires at least: 6.5
 * Requires PHP:      8.1
 * Author:            PN Suite
 * Author URI:        https://plugins.puyanovin.ir
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       pn-ai-agent
 * Domain Path:       /languages
 */

declare(strict_types=1);

use PNAIAgent\Core\Application;
use PNAIAgent\Core\Activator;
use PNAIAgent\Core\Deactivator;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PN_AI_AGENT_VERSION', '1.0.1' );
define( 'PN_AI_AGENT_FILE', __FILE__ );
define( 'PN_AI_AGENT_PATH', plugin_dir_path( __FILE__ ) );
define( 'PN_AI_AGENT_URL', plugin_dir_url( __FILE__ ) );
define( 'PN_AI_AGENT_BASENAME', plugin_basename( __FILE__ ) );


$autoload = PN_AI_AGENT_PATH . 'vendor/autoload.php';

if ( ! file_exists( $autoload ) ) {

	wp_die(
		esc_html__(
			'Composer autoload file not found.',
			'pn-ai-agent'
		)
	);

}

require_once $autoload;

register_activation_hook(
	__FILE__,
	array( Activator::class, 'activate' )
);

register_deactivation_hook(
	__FILE__,
	array( Deactivator::class, 'deactivate' )
);

Application::boot();
