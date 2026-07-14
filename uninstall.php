<?php

declare(strict_types=1);

/**
 * Uninstall PN AI Agent.
 *
 * Removes plugin settings from the WordPress database.
 *
 * @package PN_AI_Agent
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/*
|--------------------------------------------------------------------------
| Delete Plugin Options
|--------------------------------------------------------------------------
*/

$options = array(

	// General
	'pn_ai_provider',
	'pn_ai_license_key',

	// OpenAI
	'pn_ai_openai_api_url',
	'pn_ai_openai_api_key',
	'pn_ai_openai_model',

	// Google Gemini
	'pn_ai_gemini_api_url',
	'pn_ai_gemini_api_key',
	'pn_ai_gemini_model',

	// Ollama
	'pn_ai_ollama_api_url',
	'pn_ai_ollama_api_key',
	'pn_ai_ollama_model',

);

foreach ( $options as $option ) {
	delete_option( $option );
}

/*
|--------------------------------------------------------------------------
| Multisite Support
|--------------------------------------------------------------------------
*/

if ( is_multisite() ) {

	global $wpdb;

	$blogIds = $wpdb->get_col(
		"SELECT blog_id FROM {$wpdb->blogs}"
	);

	foreach ( $blogIds as $blogId ) {

		switch_to_blog( (int) $blogId );

		foreach ( $options as $option ) {
			delete_option( $option );
		}

		restore_current_blog();
	}
}
