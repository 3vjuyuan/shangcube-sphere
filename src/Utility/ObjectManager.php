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
