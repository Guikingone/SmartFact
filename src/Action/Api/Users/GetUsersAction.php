<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Action\Api\Users;

use App\Managers\API\ApiUserManager;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UsersAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class GetUsersAction
{
    /**
     * @var ApiUserManager
     */
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
     *
     * @throws \InvalidArgumentException
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
