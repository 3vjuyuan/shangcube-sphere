<?php
/**
 * Created by IntelliJ IDEA.
 * User: Weiye Sun
 * Date: 2017/8/5
 * Time: 12:37
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