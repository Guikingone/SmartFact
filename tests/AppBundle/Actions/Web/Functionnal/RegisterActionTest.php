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
 * Class RegisterActionTest
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class RegisterActionTest extends WebTestCase
{
    /** @var null */
    private $client = null;

    /** {@inheritdoc} */
    public function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * Test if the Response return the right status code.
     */
    public function testResponseStatusCode()
    {
        $this->client->request('GET', '/register');

        $this->assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * Test if the form can be hydrated and submitted.
     */
    public function testRegisterFormSubmission()
    {
        $crawler = $this->client->request('GET', '/register');

        $this->assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );

        if ($this->client->getResponse()->getStatusCode() === Response::HTTP_OK) {

            $form = $crawler->selectButton('Submit')->form();

            $form['register[username]'] = 'HP';
            $form['register[email]'] = 'hp@gmail.com';
            $form['register[plainPassword][first]'] = 'Ie1FDLP';
            $form['register[plainPassword][second]'] = 'Ie1FDLP';

            $this->client->submit($form);

        }
    }
}
