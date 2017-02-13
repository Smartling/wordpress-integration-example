<?php
namespace Smartling\Declarations;

/**
 * Class CustomPostTypes
 * @package Smartling\Declarations
 */
class CustomPostTypes
{
    public static function register()
    {
        $instance = new self();

        add_filter('smartling_register_custom_type', [$instance, 'articleCPT']);
    }

    /**
     * Registering custom post type
     *
     * @param $definitions
     *
     * @return array
     */
    public function articleCPT($definitions)
    {

        $simpleCustomPostDefinition = [
            'type' => 'article',
        ];

        $extendedCustomPostDefinition = [
            "type" =>
                [
                    /**
                     * 'identifier' is a main param.
                     * It is required.
                     * It should be same as wordpress post type.
                     */
                    'identifier' => 'article',

                    /**
                     * 'label' is a text label used in smartling connector in UI.
                     * If custom post type is properly registered 'label' is recommended to be skipped.
                     */
                    'label'      => 'CT Label', // fallback to registered, then to system

                    /**
                     * Edit screen widget settings.
                     * By default is NOT visible.
                     */
                    'widget'     => [
                        'visible' => true,
                        'message' => 'No original Article found',
                    ],

                    /**
                     * Visibility settings for smartling-connector plugin screens
                     * By default is visible on all screens
                     */
                    'visibility' => [
                        'submissionBoard' => true,
                        'bulkSubmit'      => true,
                    ],
                ],
        ];

        $definitions[] = $simpleCustomPostDefinition;

        return $definitions;
    }
}