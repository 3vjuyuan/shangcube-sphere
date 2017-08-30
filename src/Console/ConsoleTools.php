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

namespace ShangCube\Sphere\Console;

use ShangCube\Sphere\Utility\{GeneralUtility, ObjectManager};
use ShangCube\Sphere\Resource\DatabaseConnectionManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

abstract class ConsoleTools
{
    public static function run(InputInterface $input = null, OutputInterface $output = null)
    {
        $objManager = ObjectManager::getObjectManagerInstance();
        /** @var DatabaseConnectionManager $dbManager */
        $dbManager = $objManager->getObject(DatabaseConnectionManager::class);

        $databaseConnection = $dbManager->getDefaultConnection();

        $configuration = GeneralUtility::getConfiguration();
        $entityManager = EntityManager::create($databaseConnection, $configuration->getMetadataConfig());

        $helperSet = ConsoleRunner::createHelperSet($entityManager);

        $commands = array();

        if (!($helperSet instanceof HelperSet)) {
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
