<?php

namespace Smartling;

use Smartling\Extensions\Cron\CronJobTuner;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class Bootloader
 * @package Smartling\Extension
 */
class Bootloader
{
    private static $autoloaderInitialized = false;

    /**
     * Requires to run first
     *
     * @param string $pluginFile
     */
    public static function initAutoloader($pluginFile)
    {
        if (self::checkAutoloaderFile()) {
            /** @noinspection PhpIncludeInspection */
            require_once self::getAutoloaderFile();
            self::$autoloaderInitialized = true;

        } else {
            self::displayErrorMessage(
                vsprintf(
                    'Composer autoload file is missing. Plugin <strong>%s</strong> functionality is disabled.',
                    [self::getPluginName($pluginFile)]
                )
            );
        }
    }

    /**
     * Builds path to composer autoloader
     * @return string
     */
    private static function getAutoloaderFile()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' .
               DIRECTORY_SEPARATOR . 'third-party' . DIRECTORY_SEPARATOR . 'autoload.php';
    }

    /**
     * Checks autoloader file
     * @return bool
     */
    private static function checkAutoloaderFile()
    {
        $autoloaderFile = self::getAutoloaderFile();

        return file_exists($autoloaderFile) && is_readable($autoloaderFile);
    }

    /**
     * @param string $functionName
     * @param bool   $strict
     * @param string $message
     *
     * @return bool
     * @throws \Exception
     */
    private function checkFunction($functionName, $strict = false, $message = '')
    {
        $result = function_exists($functionName);
        if (false === $result && true === $strict) {
            throw new \Exception($message);
        } else {
            return $result;
        }
    }

    /**
     * Displays error message for diagnostics
     *
     * @param string $messageText
     */
    private static function displayErrorMessage($messageText = '')
    {
        if (self::checkFunction('add_action', true, 'This code cannot run outside of wordpress.')) {
            add_action('all_admin_notices', function () use ($messageText) {
                echo vsprintf('<div class="error"><p>%s</p></div>', array($messageText));
            });
        }
    }

    private static function getPluginMeta($pluginFile, $metaName)
    {
        $pluginData = get_file_data($pluginFile, [$metaName => $metaName]);

        return $pluginData[$metaName];
    }

    private static function getPluginName($pluginFile)
    {
        return self::getPluginMeta($pluginFile, 'Plugin Name');
    }

    private function checkConnectorVersion($pluginFile)
    {
        $requiredVersion = self::getPluginMeta($pluginFile, 'ConnectorRequiredMin');
        $realVersion = Bootstrap::$pluginVersion;

        return version_compare($requiredVersion, $realVersion, '>=');
    }

    /**
     * @param                  $pluginFile
     * @param ContainerBuilder $di
     */
    public static function boot($pluginFile, ContainerBuilder $di)
    {
        if (true === self::$autoloaderInitialized) {
            if (false === self::checkConnectorVersion($pluginFile)) {
                self::displayErrorMessage(
                    vsprintf(
                        '<strong>%s</strong> extension plugin requires <strong>%s</strong> plugin version at least<strong>%s</strong>.',
                        [self::getPluginName($pluginFile), 'Smartling Connector',
                         self::getPluginMeta($pluginFile, 'ConnectorRequiredMin')]
                    )
                );
            } else {
                (new static($di))->run();
            }
        } else {
            self::displayErrorMessage('Use <strong>initAutoloader</strong> before running <strong>boot</strong> method.');
        }
    }

    /**
     * @var ContainerBuilder
     */
    private $di;

    /**
     * @return ContainerBuilder
     */
    public function getDi()
    {
        return $this->di;
    }

    /**
     * @param ContainerBuilder $di
     */
    public function setDi($di)
    {
        $this->di = $di;
    }

    public function run()
    {
        // Uncomment next line if you need to customize
        //$this->tuneCronJobs();


        //init cpt
        //init
    }

    public function __construct(ContainerBuilder $di)
    {
        $this->setDi($di);
    }

    private function tuneCronJobs()
    {
        /**
         * An example for wpengine hosting
         */
        (new CronJobTuner($this->getDi()))
            ->setUploadJobTTL(60)
            ->setSubmissionCollectorJobTTL(60)
            ->setLastModifiedJobTTL(60)
            ->setDownloadJobTTL(60)
            ->apply();
    }
}