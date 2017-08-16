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
