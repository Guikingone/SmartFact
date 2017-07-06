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
    public function testAccountingsListStatusCode()
    {
        $this->client->request('GET', '/accountings');

        $this->assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

    }

    /**
     * Test if the Response contain the right status code.
     */
    public function testAccountingDetailsStatusCode()
    {
        $this->client->request('GET', '/accounting/1/details');

        $this->assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testAccountingNewStatusCode()
    {
        $this->client->request('GET', '/accounting/new');

        $this->assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    public function testAccountingUpdatedStatusCode()
    {

    }
}
