<?php
/**
 * Created by IntelliJ IDEA.
 * User: Weiye Sun
 * Date: 2017/7/30
 * Time: 10:57
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

    public function flush() {
        $this->persistenceManager->flush();
    }
}