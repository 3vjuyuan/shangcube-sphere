<?php

namespace ShangCube\Sphere\Utility;

use ShangCube\Sphere\Object\SingletonInterface;

class ObjectManager implements SingletonInterface
{
    /**
     * @var ObjectManager
     */
    protected static $objectManagerInstance;

    /**
     * @return ObjectManager
     */
    public static function getObjectManagerInstance() {
        if(static::$objectManagerInstance === null) {
            static::$objectManagerInstance = new static();
        }

        return static::$objectManagerInstance;
    }

    protected $objects = [];

    protected function __construct()
    {

    }

    /**
     * @param string $className
     * @param array ...$param
     * @return mixed
     */
    public function getObject(string $className, ... $param)
    {
        if(isset($this->objects[$className])) {
            return $this->objects[$className];
        }

        $obj = new $className;
        if($obj instanceof SingletonInterface) {
            $this->objects[$className] = $obj;
        }

        return $obj;
    }
}