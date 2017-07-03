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

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class HomeActionTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class HomeActionTest extends WebTestCase
{
    private $client = null;

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
        $this->client->request('GET', '/');

        $this->assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }
}
