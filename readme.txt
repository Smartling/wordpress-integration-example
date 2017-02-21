=== Smartling Integration example ===

Contributors: smartling
Tags: automation, international, internationalisation, internationalization, localisation, localization, multilingual, smartling, translate, translation
Requires at least: 4.6
Tested up to: 4.7.2
Stable tag: 1.1
License: GPL-3.0 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.txt

Small plugin with example how to translate custom content types by Smartling Connector

== Description ==

[The Smartling Connector](https://wordpress.org/plugins/smartling-connector) extends the WordPress interface for seamless management of the translation process. This plugin demonstrates how Smartling Connector can be extended. An example:
* How to add localization support for your custom content types
* How to configure logging to write into another destination
* How to adjust Smartling cron jobs parameters

Integration Features

* Automatic change detection for content updates
* Robust custom workflow engine configurable per language
* Automatic download of completed translations to WordPress
* Translation Memory integration
* No tie-ins to translation agencies or vendors
* Reporting for translation velocity, efficiency

== Installation ==

= Minimum Requirements =
* WordPress 4.6 or higher
* [Smartling Connector](https://wordpress.org/plugins/smartling-connector) 4.1 or higher

1. Upload the plugin files to the `/wp-content/plugins/smartling-integration-example` directory, or install the plugin through the WordPress plugins screen directly.
1. Go to the Plugins screen and **Network Activate** the ACF localization plugin.

== Frequently Asked Questions ==

Additional information on the Smartling Connector for WordPress can be found [there](http://help.smartling.com/knowledge-base/sections/wordpress-connector/).

== Changelog ==

= 1.1 =

* Added class autoloader.
* Added validation of Smartling Connector version at startup.
* Added example how to tune Smartling cron jobs. It may be useful in case you use WPEngine hosting.
* Updated example how to register custom post type and custom taxonomy types handlers. Now it uses the new `smartling_register_custom_type` filter.

= 1.0 =

The initial release.
* Example of custom post type and custom taxonomy.
* Example how to register custom types in Smartling Connector. After this custom assets are available on Smartling Bulk Submit screen for submitting to Smartling.
