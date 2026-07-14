<?php
/**
 * Dashboard Page
 *
 * @package PN_AI_Agent
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$plugins = array(
	'pn-license-gateway' => array(
		'name'         => 'PN License Gateway',
		'description'  => 'Complete license management and payment gateway solution for Easy Digital Downloads',
		'icon'         => '🔑',
		'color'        => '#4f46e5',
		'slug'         => 'pn-license-gateway',
		'file'         => 'pn-license-gateway/pn-license-gateway.php',
		'download_url' => 'https://plugins.puyanovin.ir/downloads/pn-license-gateway/',
		'is_active'    => class_exists( 'PN_License_Gateway' ),
	),
	'pn-paid-edd'        => array(
		'name'         => 'PN Paid EDD',
		'description'  => 'Connect Easy Digital Downloads with Paid Memberships Pro for seamless payment and membership management',
		'icon'         => '🛒',
		'color'        => '#10b981',
		'slug'         => 'pn-paid-edd',
		'file'         => 'pn-paid-edd/pn-paid-edd.php',
		'download_url' => 'https://plugins.puyanovin.ir/downloads/pn-paid-edd/',
		'is_active'    => class_exists( 'PN_Paid_EDD' ),
	),
	'pn-aibot'           => array(
		'name'         => 'PN AIBot',
		'description'  => 'Intelligent AI chatbot for WordPress with OpenAI and DeepSeek integration',
		'icon'         => '🤖',
		'color'        => '#f59e0b',
		'slug'         => 'pn-aibot',
		'file'         => 'pn-aibot/pn-aibot.php',
		'download_url' => 'https://plugins.puyanovin.ir/downloads/pn-aibot/',
		'is_active'    => class_exists( 'PN_AI_Agent' ),
	),
	'pn-zoho-smtp'       => array(
		'name'         => 'PN Zoho SMTP',
		'description'  => 'Connect your WordPress site to Zoho Mail using SMTP or REST API',
		'icon'         => '📧',
		'color'        => '#ef4444',
		'slug'         => 'pn-zoho-smtp',
		'file'         => 'pn-zoho-smtp/pn-zoho-smtp.php',
		'download_url' => 'https://plugins.puyanovin.ir/downloads/pn-zoho-smtp/',
		'is_active'    => class_exists( 'PN_Zoho_SMTP' ),
	),
);
?>




