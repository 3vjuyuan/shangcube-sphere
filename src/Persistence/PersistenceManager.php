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

namespace ShangCube\Sphere\Persistence;

use ShangCube\Sphere\Utility\{GeneralUtility, ObjectManager};
use ShangCube\Sphere\Resource\{DatabaseConnection, DatabaseConnectionManager};
use ShangCube\Sphere\Domain\DomainObject;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Persisters\Entity\EntityPersister;

/**
 * Class PersistenceManager
 * @package ShangCube\Sphere\Persistence
 */
class PersistenceManager
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var DatabaseConnection
     */
    protected $databaseConnection;

    /**
     * @var EntityPersister
     */
    protected $persistence;

    /**
     * PersistenceManager constructor.
     * @param string $entityClassName
     */
    public function __construct(string $entityClassName)
    {
        /** @var DatabaseConnectionManager $connectionManager */
        $connectionManager = ObjectManager::getObjectManagerInstance()->getObject(DatabaseConnectionManager::class);
        $this->databaseConnection = $connectionManager->getDefaultConnection();

        $configuration = GeneralUtility::getConfiguration();
        $this->entityManager = EntityManager::create($this->databaseConnection, $configuration->getMetadataConfig());

        $this->persistence = $this->entityManager->getUnitOfWork()->getEntityPersister($entityClassName);
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager() {
        return $this->entityManager;
    }

    /**
     * @param string $entityClassName
     * @param mixed $id
     * @param int|null $lockMode
     * @param int|null $lockVersion
     * @return null|object
     */
    public function find(string $entityClassName, $id, $lockMode = null, $lockVersion = null) {
        return $this->entityManager->find($entityClassName, $id, $lockMode, $lockVersion);
    }

    /**
     * @param array|null $orderBy
     * @return array
     */
    public function findAll(array $orderBy = null) {
        return $this->persistence->loadAll([], $orderBy);
    }

    /**
     * @param array $criteria
     * @param carray|null $orderBy
     * @param null $limit
     * @param null $offset
     * @return array
     */
    public function findBy(array $criteria, carray $orderBy = null, $limit = null, $offset = null) {
        return $this->persistence->loadAll($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @return null|object
     */
    public function findOneBy(array $criteria, array $orderBy = null) {
        return $this->persistence->load($criteria, null, null, [], null, 1, $orderBy);
    }

    public function persist(DomainObject $entity) {
        $this->entityManager->persist($entity);
    }

    public function remove(DomainObject $entity) {
        $this->entityManager->remove($entity);
    }

    public function flush() {
        $this->entityManager->flush();
    }
}
