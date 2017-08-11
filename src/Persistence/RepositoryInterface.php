<?php
/**
 * Created by IntelliJ IDEA.
 * User: Weiye Sun
 * Date: 2017/7/30
 * Time: 16:35
 */

namespace ShangCube\Sphere\Persistence;

use Doctrine\Common\Persistence\ObjectRepository;
use ShangCube\Sphere\Domain\DomainObject;

interface RepositoryInterface extends ObjectRepository
{
    public function find($id): DomainObject;

    public function getEntityClassName(): string ;

    public function save(DomainObject $entity);

    public function remove(DomainObject $entity);
}