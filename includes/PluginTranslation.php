<?php

namespace CodeCrafts\Certificates\Includes;

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 */
class PluginTranslation
{
	/**
	 * Load the plugin text domain for translation.
	 */
	public function loadPluginTextdomain(): bool
	{
		return load_plugin_textdomain(
			$domain = 'codecrafts-certificates',
			$deprecated = false,
			$pluginRelativePath = dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}
}
