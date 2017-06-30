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

// Core
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class LoginActionTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class LoginActionTest extends WebTestCase
{
    /** @var null */
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
    public function testLoginPageStatusCode()
    {
        $this->blackfire = new Client();
        $probe = $this->blackfire->createProbe();

        $this->client->request('GET', '/login');

        $this->assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        $this->blackfire->endProbe($probe);
    }

    /**
     * Test if the submission work.
     */
    public function testLoginFormSubmission()
    {
        $this->blackfire = new Client();
        $probe = $this->blackfire->createProbe();

        $this->client->request('GET', '/login');

        $this->assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        if ($this->client->getResponse()->getStatusCode() === Response::HTTP_OK) {

        }

        $this->blackfire->endProbe($probe);
    }
}
