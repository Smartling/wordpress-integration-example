<?php

namespace Smartling\Declarations;

/**
 * Class FieldFilters
 * @package Smartling\Declarations
 */
class FieldFilters
{

    public static function register()
    {
        $instance = new self();

        add_filter('smartling_register_field_filter', [$instance, 'registerFieldFilters']);
    }

    public function registerFieldFilters($definitions)
    {
        $example = [
            /*
            [
                'pattern' => 'id',
                'action'  => 'skip',
            ],
            [
                'pattern' => 'phone',
                'action'  => 'copy',
            ],*/
            /*[
                'pattern'       => 'related_post_id',
                'action'        => 'localize',
                'serialization' => 'none',
                'value'         => 'reference',
                'type'          => 'post',
            ],
            [
                'pattern'       => 'category',
                'action'        => 'localize',
                'serialization' => 'none',
                'value'         => 'reference',
                'type'          => 'category',
            ],*/
            /*[
                'pattern'       => '^include_categories$',
                'action'        => 'localize',
                'serialization' => 'coma-separated',
                'value'         => 'reference',
                'type'          => 'category',
            ],
            [
                'pattern'       => '_thumbnail_id',
                'action'        => 'localize',
                'serialization' => 'none',
                'value'         => 'reference',
                'type'          => 'media',
            ],
            [
                'pattern'       => 'adv_image', //page_id='1,3,5,7'
                'action'        => 'localize',
                'serialization' => 'none',
                'value'         => 'raw',
                'type'          => 'media',
            ],
            */
        ];


        [

            "fields" => [
                [
                    "pattern"       => "<field name or regex>", // required

                    // What to do with field value:
                    // * "copy" - simple copy value from source to target
                    // * "skip" - don't copy value. Target will have empty value unless it will be populated somehow else
                    // * "localize" - send value for translation or transform it. Use this action for references also
                    "action"        => "copy|skip|localize", // required

                    // Preprocess value before localize it
                    // * "none"             - means that fiels contains single id
                    // * "array-value"      - means that value is an array that is already dererialized
                    // * "coma-delimited"   - means that malue contains list of ids separated by coma
                    // * "<custom>"         - means that a custom searializer may be applied
                    "serialization" => "none|array-value|coma-delimited|<custom>", // required if action=localize

                    // How to handle value
                    // * "raw" - use value as is
                    // * "reference" - value is reference to another entity (post\tag\attachment\etc)
                    "value"         => "raw|reference", // required implemented ONLY 'reference'

                    // Type of reference\url
                    // post - any post-based type
                    // media - image or attachment
                    // <custom_type> - e.g.: taxonomy:category
                    "type"          => "post|media|<custom_type>", // required if action=localize
                ],
            ],
        ];

        $definitions = array_merge($definitions, $example);

        return $definitions;

    }
}


