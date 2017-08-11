<?php
/**
 * Created by IntelliJ IDEA.
 * User: Weiye Sun
 * Date: 2017/8/5
 * Time: 19:04
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