<?php

/**
 * Class ContentTypeArticleType
 *
 * This is a class that describes 'article_type' taxonomy to smartling-connector plugin.
 */
class ContentTypeArticleType extends \Smartling\ContentTypes\ContentTypePostTag
{
    const WP_CONTENT_TYPE = 'article_type';
    
    public function registerWidgetHandler() {}
}