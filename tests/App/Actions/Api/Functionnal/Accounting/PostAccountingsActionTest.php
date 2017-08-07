<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\App\Actions\Api\Functionnal\Accounting;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class PostAccountingsActionTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class PostAccountingsActionTest extends WebTestCase
{
    /**
     * @var null
     */
    private $client = null;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * Test if the API respond with the right headers.
     */
    public function testResponse()
    {
        $this->client->request('POST', '/api/accountings/post', [], [], [], [
            'name' => 'TestAccounting',
            'interlocutor' => 'Mr Test',
            'address' => '404 Not Found',
            'phoneNumber' => '0875645336',
            'email' => 'mrtest@testaccounting.com'
        ]);

        static::assertEquals(
            Response::HTTP_CREATED,
            $this->client->getResponse()->getStatusCode()
        );

        static::assertTrue(
            $this->client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );
    }
}
