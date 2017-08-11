<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use ShangCube\Sphere\Product;
use ShangCube\Sphere\User;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
//$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);
// or if you prefer yaml or XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_mysql',
    'url' => 'mysql://shangcube:shangcube@localhost/shangcube',
);

$entityManager = EntityManager::create($conn, $config);

//$productRepository = $entityManager->getRepository('ShangCube\Sphere\Product');
$userRepository = $entityManager->getRepository('ShangCube\Sphere\User');
////
////var_dump($productRepository->findBy(['firstname' => 'Yuanyuan']));
//
//var_dump($productRepository->findAll());
//var_dump($userRepository->findAll());
//echo '<br>----------------------------------------------<br>';
//var_dump($userRepository->findBy(['firstname' => 'Yuanyuan']));
//echo '<br>----------------------------------------------<br>';
//var_dump($userRepository->findBy(['firstname' => 'Jiannan']));
$user = $userRepository->find(3);
$user->setSex(2);
$entityManager->persist($user);

$entityManager->flush();

echo 'remove';
//$user = new User();
//$user->setUsername('jiannan');
//$user->setFirstname('Jiannan');
//$user->setLastname('Zhang');
//$user->setBirthday(10839232);
//$user->setSex(0);
//$user->setIdentify('zhangjiannan@3vjuyuan.com');
//
//$user1 = new User();
//$user1->setUsername('wmy');
//$user1->setFirstname('Mengyu');
//$user1->setLastname('Wen');
//$user1->setBirthday(47234782);
//$user1->setSex(1);
//$user1->setIdentify('wenmengyu@3vjuyuan.com');
//$entityManager->persist($user);
//$entityManager->persist($user1);
//$entityManager->flush();
//
echo 'New User Id of: ' . $user->getUsername() . ' is ' . $user->getId() . '.';
//echo 'New User Id of: ' . $user1->getUsername() . ' is ' . $user1->getId() . '.';

//$product = new Product();
//$product->setName('mianmo');
//$product->setSku('11234');
//$product->setPrice(100);
//$product->setDescription('haoyongdemianmo');
//$product->setAmount(0);
//$product->setBrand('bobo');
////$product->setImage('fakdjflkalkdfkla');
//$product->setCategories('fenlei1');
//
////$productRepository->add($product);
//$entityManager->persist($product);
//$entityManager->flush();