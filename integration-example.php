<?php
/**
 * @link              https://www.smartling.com
 * @since             1.0.0
 * @package           smartling-integration-example
 * @wordpress-plugin
 * Plugin Name:       Smartling and Customizations
 * Description:       Shows how to translate custom content types
 * Author:            smartling
 * Author URI:        https://www.smartling.com
 * Plugin URI:        https://www.smartling.com/translation-software/wordpress-translation-plugin/
 * License:           GPL-3.0+
 * Network:           true
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * ConnectorRequiredMin: 4.1
 * Version: 1.1
 */

/**
 * Autoloader starts always
 */
if (!class_exists('\Smartling\Bootloader')) {
    require_once plugin_dir_path(__FILE__) . 'src/Bootloader.php';
    \Smartling\Bootloader::initAutoloader(__FILE__);
}

/**
 * Always declaring custom types
 */
require_once __DIR__ . "/src/Declarations/custom-content-types-registrations.php";

if (is_admin() || (defined('DOING_CRON') && true === DOING_CRON)) {

    if (!class_exists('\Smartling\Bootloader')) {
        require_once plugin_dir_path(__FILE__) . 'src/Bootloader.php';
        \Smartling\Bootloader::initAutoloader(__FILE__);
    }

    add_action('plugins_loaded', function () {
        add_action('smartling_before_init', function (\Symfony\Component\DependencyInjection\ContainerBuilder $di) {
            add_action('init', function () use ($di) {
                \Smartling\Declarations\CustomTaxonomies::register();
                \Smartling\Declarations\CustomPostTypes::register();
                \Smartling\Declarations\FieldFilters::register();

                \Smartling\Bootloader::boot(__FILE__, $di);
            });

            \Smartling\Extension\ShortcodeInjector::addShortcode('vc_row');
            \Smartling\Extension\ShortcodeInjector::inject();

        });
    });
}