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
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ApiResetPasswordTokenAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class ApiResetPasswordTokenAction
{
    /**
     * @var ApiSecurityManager
     */
    private $manager;

    /**
     * ApiResetPasswordTokenAction constructor.
     * @param ApiSecurityManager $manager
     */
    public function __construct(ApiSecurityManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param Request                $request
     *
     * @throws \LogicException
     * @throws ApiJsonException
     * @throws \InvalidArgumentException
     *
     * @return JsonResponse           The response who contain the token.
     */
    public function __invoke(Request $request) : JsonResponse
    {
        $result = $this->manager->resetPasswordTokenViaCredentials($request->getContent());

        return new JsonResponse(
            [
                'token' => $result
            ],
            JsonResponse::HTTP_CREATED
        );
    }
}
