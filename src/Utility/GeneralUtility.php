<?php
/**
 * Copyright (c) 2014-present, San Wei Ju Yuan Tech Ltd. <https://www.3vjuyuan.com>
 * This file is part of sphere-framework
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 *
 * For more details:
 * https://www.3vjuyuan.com/licenses.html
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
    public static function getConfiguration()
    {
        if (!isset(self::$configuration)) {
            self::$configuration = new class extends Configuration
            {
                protected function initialize()
                {
                    $databaseParameter = [];

                    // @todo Database configuration should be got from database driver utility with different support
                    if ($url = getenv('DATABASE_URL')) {
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

    public static function makeObjectInstance($className)
    {

    }
}
