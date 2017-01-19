<?php
/**
 * Plugin Name: Smartling and Customizations
 * Plugin Description: Shows how to translate custom content types
 * Plugin URI: http://smartling.com
 * Author: smartling
 * Version: 0.1
 */

$wp_extension_path_prefix = __DIR__ . DIRECTORY_SEPARATOR . 'Wordpress' . DIRECTORY_SEPARATOR;

require_once $wp_extension_path_prefix  . 'ArticlePostTypeDeclaration.php';
require_once $wp_extension_path_prefix  . 'ArticleTypeTaxonomyDeclaration.php';

add_action('plugins_loaded', function () {
    add_action('smartling_before_init', function (\Symfony\Component\DependencyInjection\ContainerBuilder $di) {

        $smartling_extension_path = __DIR__ . DIRECTORY_SEPARATOR . 'Smartling' . DIRECTORY_SEPARATOR;

        require_once $smartling_extension_path . 'ContentTypeArticleType.php';
        ContentTypeArticleType::register($di);

        require_once $smartling_extension_path . 'ContentTypeArticle.php';
        ContentTypeArticle::register($di);
    });
});