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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetPersonalUserAction
 * 
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class GetPersonalUserAction
{
    /**
     * @var ApiUserManager
     */
    private $manager;

    /**
     * GetPersonalUserAction constructor.
     * @param ApiUserManager $manager
     */
    public function __construct(ApiUserManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @throws \InvalidArgumentException
     *
     * @return Response
     */
    public function __invoke(Request $request) : Response
    {
        $headers = $request->headers->all();


        $this->manager->getPersonalUser($headers);

        return new Response(
            '',
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
