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
use App\Exceptions\ApiJsonException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class DeleteUserAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class DeleteUserAction
{
    /**
     * @var ApiUserManager
     */
    private $manager;

    /**
     * DeleteUserAction constructor.
     *
     * @param ApiUserManager     $manager
     */
    public function __construct(ApiUserManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param Request $request              The request who contain the identifier.
     *
     * @throws ApiJsonException             If no entity can be found.
     * @throws \InvalidArgumentException    Thrown by the DocumentManager.
     *
     * @return JsonResponse                 The response with the action message.
     */
    public function __invoke(Request $request) : JsonResponse
    {
        $identifier = $request->get('id');

        $this->manager->deleteUser($identifier);

        return new JsonResponse(
            [
                'message' => 'Resource deleted.'
            ],
            JsonResponse::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
