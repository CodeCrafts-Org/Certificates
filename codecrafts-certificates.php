<?php

/**
 * Plugin Name: Certificates
 * Description: Gerador de certificados para WordPress.
 * Version: 1.0.0
 * Author: Ciro Dourado de Oliveira
 */

require_once __DIR__ . '/vendor/autoload.php';

use CodeCrafts\Certificates\Src\DependencyInjectionContainers\ApplicationContainer;
use CodeCrafts\Certificates\Includes\Plugin;
use CodeCrafts\Certificates\Includes\PluginActivator;
use CodeCrafts\Certificates\Includes\PluginDeactivator;
use CodeCrafts\Certificates\Includes\PluginLoader;

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @package           CodeCrafts_Certificates
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

register_activation_hook(__FILE__, [new PluginActivator, 'activate']);
register_deactivation_hook(__FILE__, [new PluginDeactivator, 'deactivate']);

include 'functions.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 */
$plugin = new Plugin(
	/* pluginLoader: */ new PluginLoader(),
	/* name: */ 'codecrafts-certificates',
	/* version: */ '1.0.0',
	/* applicationContainer: */ new ApplicationContainer()
);
$plugin->run();
