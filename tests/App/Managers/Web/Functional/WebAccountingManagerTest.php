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
 * Class WebAccoutingTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class WebAccountingManagerTest extends WebTestCase
{
    /** @var null */
    private $client = null;

    /** {@inheritdoc} */
    public function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * Test if the Response contain the right status code.
     */
    public function testAccountingsList()
    {
        $this->client->request('GET', '/accountings');

        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

    }

    /**
     * Test if the Response contain the right status code.
     */
    public function testAccountingDetails()
    {
        $this->client->request('GET', '/accounting/1/details');

        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * Test if a new Accounting can be created.
     */
    public function testAccountingCreation()
    {
        $this->client->request('GET', '/accounting/new');

        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        if ($this->client->getResponse()->getStatusCode() === Response::HTTP_OK) {

            // To crawl.
        }
    }

    /**
     * Test if an Accounting can be udapted.
     */
    public function testAccountingUpdate()
    {
        $this->client->request('GET', '/accounting/1/update');

        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        if ($this->client->getResponse()->getStatusCode() === Response::HTTP_OK) {

            // To crawl.
        }
    }
}
