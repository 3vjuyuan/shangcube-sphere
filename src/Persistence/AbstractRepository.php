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

namespace ShangCube\Sphere\Persistence;

use ShangCube\Sphere\Domain\DomainObject;

/**
 * Class AbstractRepository
 * @package ShangCube\Sphere\Persistence
 */
abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @var PersistenceManager
     */
    protected $persistenceManager;

    /**
     * @var string
     */
    protected $entityClassName;

    /**
     * AbstractRepository constructor.
     * @param string $entityClassName
     * @deprecated The constructor will be remove by using dependency injection.
     *
     * Do not use new to create repository object, but using ObjectManager::get(), which supports the
     * dependency injection later
     */
    public function __construct(string $entityClassName)
    {
        $this->entityClassName = $entityClassName;
        $this->persistenceManager = new PersistenceManager($entityClassName);
    }

    public function findAll(array $orderBy = null)
    {
        return $this->persistenceManager->findAll($orderBy);
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->persistenceManager->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function findOneBy(array $criteria, array $orderBy = null)
    {
        return $this->persistenceManager->findOneBy($criteria, $orderBy);
    }

    public function find($id): DomainObject
    {
        return $this->persistenceManager->find($this->entityClassName, $id);
    }

    /**
     * @return string
     */
    final public function getClassName()
    {
        return $this->getEntityClassName();
    }

    /**
     * @return string
     */
    public function getEntityClassName(): string
    {
        return $this->entityClassName;
    }

    public function save(DomainObject $entity)
    {
        $this->persistenceManager->persist($entity);
    }

    public function remove(DomainObject $entity)
    {
        $this->persistenceManager->remove($entity);
    }

    public function flush()
    {
        $this->persistenceManager->flush();
    }
}
