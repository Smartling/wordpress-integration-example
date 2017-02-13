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


/**
 * Execute ONLY for admin pages
 */
if (is_admin()){
    add_action('plugins_loaded', function () {
        add_action('smartling_before_init', function (\Symfony\Component\DependencyInjection\ContainerBuilder $di) {

            add_action('init', function () use ($di) {

                \Smartling\Declarations\CustomTaxonomies::register();
                \Smartling\Declarations\CustomPostTypes::register();

                \Smartling\Bootloader::boot(__FILE__,$di);
            });



        });
    });
}