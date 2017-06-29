<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Action\Api\Users;

// Manager
use AppBundle\Managers\API\ApiUserManager;

// Core
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class UsersAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @Route("/users", name="api_users")
 *
 * @Method({"GET"})
 */
final class UsersAction
{
    /** @var ApiUserManager */
    private $manager;

    /**
     * UsersAction constructor.
     *
     * @param ApiUserManager    $manager
     */
    public function __construct(
        ApiUserManager $manager
    ) {
        $this->manager = $manager;
    }

    /**
     * @return Response
     */
    public function __invoke()
    {
        return new Response(
            $this->manager->getUsers(),
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
