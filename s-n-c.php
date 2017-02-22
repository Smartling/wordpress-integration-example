<?php
/**
 * Plugin Name: Smartling and Customizations
 * Plugin Description: Shows how to translate custom content types
 * Plugin URI: http://smartling.com
 * Author: smartling
 * ConnectorRequiredMin: 4.1
 * Version: 0.2
 */

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


        });

        \Smartling\Extension\ShortcodeInjector::addShortcode('vc_row');
        \Smartling\Extension\ShortcodeInjector::inject();

    });
}