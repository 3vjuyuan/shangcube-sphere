<?php

require_once "vendor/autoload.php";

use ShangCube\Sphere\Utility\ObjectManager;
use ShangCube\Sphere\Resource\DatabaseConnectionManager;
use Symfony\Component\Dotenv\Dotenv;
use ShangCube\Sphere\Product;
use ShangCube\Sphere\ProductRepository;


(new Dotenv())->load(__DIR__.'/.env');

$objManager = ObjectManager::getObjectManagerInstance();
$repository = $objManager->getObject(ProductRepository::class);
//$products = $repository->findOneBy(['uid'=>'1']);
$products = $repository->find(1);
var_dump($products);