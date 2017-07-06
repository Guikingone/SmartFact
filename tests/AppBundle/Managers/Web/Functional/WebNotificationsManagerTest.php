<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\AppBundle\Managers\Web\Functional;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class WebNotificationsManagerTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class WebNotificationsManagerTest extends WebTestCase
{
    /** @var null */
    private $client = null;

    /** {@inheritdoc} */
    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testUserNotifications()
    {
        $this->client->request('GET', '/user/1/notifications');

        $this->assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }
}
