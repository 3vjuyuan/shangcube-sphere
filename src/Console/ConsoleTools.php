<?php
/**
 * Created by IntelliJ IDEA.
 * User: Weiye Sun
 * Date: 2017/8/10
 * Time: 23:29
 */

namespace ShangCube\Sphere\Console;

use ShangCube\Sphere\Utility\{GeneralUtility, ObjectManager};
use ShangCube\Sphere\Resource\DatabaseConnectionManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

abstract class ConsoleTools
{
    public static function run(InputInterface $input = null, OutputInterface $output = null) {



        $objManager = ObjectManager::getObjectManagerInstance();
        /** @var DatabaseConnectionManager $dbManager */
        $dbManager = $objManager->getObject(DatabaseConnectionManager::class);

        $databaseConnection = $dbManager->getDefaultConnection();

        $configuration = GeneralUtility::getConfiguration();
        $entityManager = EntityManager::create($databaseConnection, $configuration->getMetadataConfig());

        $helperSet = ConsoleRunner::createHelperSet($entityManager);

        $commands = array();

        if ( ! ($helperSet instanceof HelperSet)) {
            foreach ($GLOBALS as $helperSetCandidate) {
                if ($helperSetCandidate instanceof HelperSet) {
                    $helperSet = $helperSetCandidate;
                    break;
                }
            }
        }

        ConsoleRunner::run($helperSet, $commands);
    }
}