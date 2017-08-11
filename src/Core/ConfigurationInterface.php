<?php
/**
 * Created by IntelliJ IDEA.
 * User: Weiye Sun
 * Date: 2017/8/5
 * Time: 19:17
 */

namespace ShangCube\Sphere\Core;


interface ConfigurationInterface extends \Serializable
{
    const SCHEMA_TYPE_XML = 10;
    const SCHEMA_TYPE_YAML = 11;

    public function getMetadataConfig();

    public function getDatabaseConnectionParameter();
}