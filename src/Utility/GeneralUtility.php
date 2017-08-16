<?php
/**
 * Copyright (c) 2014-present, San Wei Ju Yuan Tech Ltd. <https://www.3vjuyuan.com>
 * All rights reserved.
 *
 * This file is part of swim-reformer, licensed under the MIT license (MIT) found
 * in the LICENSE file in the root directory of this source tree.
 *
 * For more details:
 * https://www.3vjuyuan.com/licenses/mit.html
 *
 * @author Team Delta <delta@3vjuyuan.com>
 */

namespace ShangCube\Sphere\Utility;

use ShangCube\Sphere\Core\Configuration;
use ShangCube\Sphere\Core\ConfigurationInterface;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;

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
                    $this->metadataConfig->setNamingStrategy(new UnderscoreNamingStrategy(CASE_LOWER));
                }
            };
        }

        return self::$configuration;
    }

    public static function makeObjectInstance($className) {

    }
}
