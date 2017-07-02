<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace tests\AppBundle\Actions\Web\French\Functionnal;

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
        $this->client->request('GET', '/fr/login');

        $this->assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * Test if the submission work.
     */
    public function testLoginFormSubmission()
    {
        $crawler = $this->client->request('GET', '/fr/login');

        $this->assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        if ($this->client->getResponse()->getStatusCode() === Response::HTTP_OK) {

            $form = $crawler->selectButton('Submit')->form();

            $form['login[_username]'] = "Harry";
            $form['login[_password]'] = "Potter";

            $this->client->submit($form);

            $this->assertEquals(
                Response::HTTP_OK,
                $this->client->getResponse()->getStatusCode()
            );
        }
    }
}
