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

use App\Exceptions\ApiJsonException;
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
     *
     * @param ApiUserManager    $manager
     */
    public function __construct(ApiUserManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param $request  Request             The Request who contain the api token.
     *
     * @throws ApiJsonException             If no headers are passed.
     * @throws \InvalidArgumentException    @see Response
     * @throws ApiJsonException             @see ApiUserManager::getPersonalUser()
     *
     * @return Response                     The response with the user informations.
     */
    public function __invoke(Request $request) : Response
    {
        $headers = $request->headers->get('authorization');

        if (!$headers) {
            throw new ApiJsonException(
                \sprintf(
                    'An API token must be passed, none given !'
                )
            );
        }

        $informations = $this->manager->getPersonalUser($headers);

        return new Response(
            $informations,
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
