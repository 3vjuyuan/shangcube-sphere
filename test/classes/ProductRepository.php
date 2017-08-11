<?php
namespace ShangCube\Sphere;

class ProductRepository extends Persistence\AbstractRepository
{
    public function __construct()
    {
        parent::__construct($entityClassName = Product::class);
    }

}