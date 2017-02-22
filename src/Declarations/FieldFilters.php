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
            [
                'pattern' => 'id',
                'action'  => 'skip',
            ],
            [
                'pattern' => 'phone',
                'action'  => 'copy',
            ],
            [
                'pattern'       => 'page_id', //page_id='1,3,5,7'
                'action'        => 'localize',
                'serialization' => 'coma-delimited',
                'value'         => 'reference',
                'type'          => 'post',
            ],
            [
                'pattern'       => 'images', //images='1,3,5,7'
                'action'        => 'localize',
                'serialization' => 'coma-delimited',
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
        ];


        [

            "fields" => [
                [

                    "filed_pattern" => "<field name or regex>", // required
                    "behavior"      => [ // required
                                         // What to do with field value:
                                         // * "copy" - simple copy value from source to target
                                         // * "skip" - don't copy value. Target will have empty value unless it will be populated somehow else
                                         // * "localize" - send value for translation or transform it. Use this action for references also
                                         "action"        => "copy|skip|localize", // required
                                         // Preprocess value before localize it
                                         // * "none" - no extra preprocessing for value
                                         // * "delimited" - value should be converted to array. An example "1, 4, 10"
                                         // * "array" - value is serialized php array
                                         // * "json" - value is json
                                         "serialization" => "none|delimited|array|json",
                                         // optional, default none
                                         // How to handle value
                                         // * "raw" - use value as is
                                         // * "reference" - value is reference to another entity (post\tag\attachment\etc)
                                         // * "url" - value is url to attachment (file\image)
                                         "value"         => "raw|reference", // required
                                         // Type of reference\url
                                         // post - any post-based type
                                         // media - image or attachment
                                         // taxonomy:<taxonomy_name> - e.g.: taxonomy:category
                                         // virtual:<typename> - tells that type if fully virtual
                                         "type"          => "post|media|taxonomy:category|virtual:<typename>",
                                         // if action != skip ==> required
                    ],
                ],
            ],
        ];

        $definitions = array_merge($definitions, $example);

        return $definitions;

    }
}


