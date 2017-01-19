<?php

/**
 * Class ContentTypeArticle
 *
 * This is a class that describes 'article' content-type to smartling-connector plugin.
 */
class ContentTypeArticle extends \Smartling\ContentTypes\ContentTypePost
{
    /**
     * The system name of Wordpress content type to make references safe.
     */
    const WP_CONTENT_TYPE = 'article';

    /**
     * Handler to register Widget (Edit Screen)
     *
     * Here we describe (register in DI container) a widget for edit screen
     * @return void
     */
    public function registerWidgetHandler()
    {
        $di = $this->getContainerBuilder();

        $definition = $di
            ->register('wp.article', 'Smartling\WP\Controller\PostBasedWidgetControllerStd')
            ->addArgument($di->getDefinition('logger'))
            ->addArgument($di->getDefinition('multilang.proxy'))
            ->addArgument($di->getDefinition('plugin.info'))
            ->addArgument($di->getDefinition('entity.helper'))
            ->addArgument($di->getDefinition('manager.submission'))
            ->addArgument($di->getDefinition('site.cache'))
            ->addMethodCall('setDetectChangesHelper', [$di->getDefinition('detect-changes.helper')])
            ->addMethodCall('setAbilityNeeded', ['edit_post'])
            ->addMethodCall('setServedContentType', [$this->getSystemName()])
            ->addMethodCall('setNoOriginalFound', [__('No original articles found')]);

        $di->getDefinition('manager.register')->addMethodCall('addService', [$definition]);
    }

    /**
     * Handler to register IO Wrapper
     *
     * Here we describe (register in DI container) how smartling-connector plugin will read and write articles
     * @return void
     */
    public function registerIOWrapper()
    {
        $di = $this->getContainerBuilder();
        $wrapperId = 'wrapper.entity.' . $this->getSystemName();
        $definition = $di->register($wrapperId, 'Smartling\DbAl\WordpressContentEntities\PostEntityStd');
        $definition
            ->addArgument($di->getDefinition('logger'))
            ->addArgument($this->getSystemName())
            ->addArgument([\Smartling\ContentTypes\ContentTypePostTag::WP_CONTENT_TYPE, ContentTypeArticleType::WP_CONTENT_TYPE]);

        $di->get('factory.contentIO')->registerHandler($this->getSystemName(), $di->get($wrapperId));

    }
}