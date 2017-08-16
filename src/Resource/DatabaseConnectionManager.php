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

namespace ShangCube\Sphere\Resource;

use Doctrine\DBAL\DriverManager;
use ShangCube\Sphere\Core\ConfigurationInterface;
use ShangCube\Sphere\Utility\GeneralUtility;
use ShangCube\Sphere\Object\SingletonInterface;
use SplObjectStorage;

/**
 * Class DatabaseConnectionManager
 * @package ShangCube\Sphere\Resource
 */
class DatabaseConnectionManager implements SingletonInterface
{
    /**
     * @todo Use Java like Generics with DI: ObjectStorage<Configuration, Connection>
     * @var SplObjectStorage
     */
    protected $databaseConnections;

    public function __construct(string $connectionClass = DatabaseConnection::class)
    {
        $configuration = GeneralUtility::getConfiguration();
        $connectionParameters = (array) $configuration->getDatabaseConnectionParameter();
        if(count($connectionClass)) {
            $connectionParameters['wrapperClass'] = $connectionClass;
        }
        $connection = DriverManager::getConnection(
            $connectionParameters,
            $configuration->getMetadataConfig()
        );

        $this->databaseConnections = new SplObjectStorage();

        $this->databaseConnections[$configuration] = $connection;
    }

    /**
     * @todo Finish the method
     * @param ConfigurationInterface $configuration
     */
    public function setupConnection(ConfigurationInterface $configuration) {
    }

    public function getDefaultConnection()
    {
        return $this->databaseConnections[GeneralUtility::getConfiguration()];
    }

    public function getConnection(ConfigurationInterface $configuration = null)
    {
        if ($configuration === null) {
            $this->getDefaultConnection();
        }
    }

}
