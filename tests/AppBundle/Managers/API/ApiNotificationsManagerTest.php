<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\AppBundle\Managers\API;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

// Manager
use AppBundle\Managers\API\ApiNotificationsManager;

/**
 * Class ApiNotificationsManagerTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ApiNotificationsManagerTest extends KernelTestCase
{
    /** {@inheritdoc} */
    public function setUp()
    {
        static::bootKernel();
    }
}
