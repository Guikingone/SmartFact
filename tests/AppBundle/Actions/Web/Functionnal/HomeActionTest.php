<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\AppBundle\Actions\Web\Functionnal;

// Blackfire
use Blackfire\Client;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomeActionTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class HomeActionTest extends WebTestCase
{
    private $client = null;

    /** @var Client */
    private $blackfire;

    /** {@inheritdoc} */
    public function setUp()
    {
        $this->client = self::createClient();
    }

    /**
     * Test if the homepage respond in-time and with the right headers.
     */
    public function testHomepageStatusCode()
    {
        $this->blackfire = new Client();
        $probe = $this->blackfire->createProbe();

        $this->client->request('GET', '/');

        $this->assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->blackfire->endProbe($probe);
    }
}
