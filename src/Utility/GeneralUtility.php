<?php
/**
 * Created by IntelliJ IDEA.
 * User: Weiye Sun
 * Date: 2017/8/6
 * Time: 21:27
 */

namespace ShangCube\Sphere\Utility;

use ShangCube\Sphere\Core\Configuration;
use ShangCube\Sphere\Core\ConfigurationInterface;
use Doctrine\ORM\Tools\Setup;

class GeneralUtility
{
    /**
     * @var ConfigurationInterface
     */
    protected static $configuration;

    /**
     * @return ConfigurationInterface
     */
    public static function getConfiguration() {
        if(!isset(self::$configuration)) {
            self::$configuration = new class extends Configuration {
                protected function initialize()
                {
                    $databaseParameter = [];

                    // @todo Database configuration should be got from database driver utility with different support
                    if($url = getenv('DATABASE_URL')) {
                        $databaseParameter['url'] = $url;
                    }
                    $this->databaseParameter = $databaseParameter;

                    $metadataType = getenv('METADATA_TYPE');
                    $metadataPath = getenv('METADATA_PATH');
                    $this->metadataConfig = Setup::createYAMLMetadataConfiguration(array($metadataPath), true);
                }
            };
        }

        return self::$configuration;
    }

    public static function makeObjectInstance($className) {

    }
}