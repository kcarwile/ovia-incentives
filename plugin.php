<?php
/**
 * Plugin Name: Ovia Incentives Management
 * Plugin URI: 
 * Description: Prototype app to manage Employer incentives programs for Ovia apps.
 * Author: Kevin Carwile
 * Author URI: 
 * Version: 1.0.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

/* Load Only Once */
if ( class_exists( 'OviaIncentivesPlugin' ) ) {
	return;
}

/* Autoloaders */
include_once __DIR__ . '/includes/plugin-bootstrap.php';

/**
 * This plugin uses the MWP Application Framework to init.
 *
 * @return void
 */
add_action( 'mwp_framework_init', function() 
{
	/* Framework */
	$framework = MWP\Framework\Framework::instance();
	
	/**
	 * Plugin Core 
	 *
	 * Grab the main plugin instance and attach its annotated
	 * callbacks to WordPress core.
	 */
	$plugin	= Ovia\Incentives\Plugin::instance();
	$framework->attach( $plugin );

	/* Add API Endpoints */
	$framework->attach( \Ovia\Incentives\API::instance() );

	/* Register Programs */
	$plugin->registerProgram( new \Ovia\Incentives\Programs\BirthProgram );
	$plugin->registerProgram( new \Ovia\Incentives\Programs\EngagementProgram );

	/* Register Awards */
	$plugin->registerAward( new \Ovia\Incentives\Awards\PillowAward );
	
	/**
	 * Plugin Settings 
	 *
	 * Register a settings storage to the plugin which can be
	 * used to get/set/save settings to the wp_options table.
	 */
	$settings = Ovia\Incentives\Settings::instance();
	$plugin->addSettings( $settings );
	
	/* Register settings to a WP Admin page */
	// $framework->attach( $settings );
	
} );
