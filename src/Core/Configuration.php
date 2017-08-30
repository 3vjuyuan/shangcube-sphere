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

namespace ShangCube\Sphere\Core;

use Doctrine\ORM\Configuration as MetadataConfiguration;

abstract class Configuration implements ConfigurationInterface
{
    /**
     * @var MetadataConfiguration
     */
    protected $metadataConfig;

    /**
     * @var array
     */
    protected $databaseParameter;

    public function __construct()
    {
        $this->initialize();
    }

    abstract protected function initialize();

    /**
     * @return MetadataConfiguration
     */
    public function getMetadataConfig()
    {
        return $this->metadataConfig;
    }

    /**
     * @return array
     */
    public function getDatabaseConnectionParameter()
    {
        return $this->databaseParameter;
    }

    // @todo The object contains sensitive data, which should be encrypted before serializing
    public function serialize()
    {
        // TODO: Implement serialize() method.
    }

    public function unserialize($serialized)
    {
        // TODO: Implement unserialize() method.
    }
}
