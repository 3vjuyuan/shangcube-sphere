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
