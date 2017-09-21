<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Action\Security;

use App\Exceptions\ApiJsonException;
use App\Managers\API\ApiSecurityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ApiRegisterUserAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class ApiRegisterUserAction
{
    /**
     * @var ApiSecurityManager
     */
    private $manager;

    /**
     * ApiRegisterUserAction constructor.
     *
     * @param ApiSecurityManager     $manager
     */
    public function __construct(ApiSecurityManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param $request  Request
     *
     * @throws \LogicException
     * @throws ApiJsonException
     * @throws \InvalidArgumentException
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request) : JsonResponse
    {
        $credentials = $request->getContent();

        if (!$credentials) {
            return new JsonResponse(
                [
                    'error' => 'No data passed !',
                    'message' => 'No data passed !'
                ],
                Response::HTTP_BAD_REQUEST,
                ['Content-Type' => 'application/json']
            );
        }

        $this->manager->registerUserViaCredentials($credentials);

        return new JsonResponse(
            [
                'message' => 'Resource created.'
            ],
            Response::HTTP_CREATED
        );
    }
}
