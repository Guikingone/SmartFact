<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\AppBundle\Actions\Api\Functionnal;

use Blackfire\Client;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class DeleteNotificationsActionTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class DeleteNotificationsActionTest extends WebTestCase
{
    private $client = null;

    /** @var Client */
    private $blackfire;

    /** {@inheritdoc} */
    public function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * Test if the request return the right status code.
     */
    public function testStatusCode()
    {
        $this->blackfire = new Client();
        $probe = $this->blackfire->createProbe();

        $this->client->request('DELETE', '/api/users/1/notifications/delete');

        $this->assertEquals(
            Response::HTTP_ACCEPTED,
            $this->client->getResponse()->getStatusCode()
        );
    }
}
