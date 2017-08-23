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

use App\Managers\API\ApiSecurityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ApiResetPasswordAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class ApiResetPasswordAction
{
    /**
     * @var ApiSecurityManager
     */
    private $manager;

    /**
     * ApiResetPasswordAction constructor.
     *
     * @param ApiSecurityManager     $manager
     */
    public function __construct(ApiSecurityManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param Request $request
     *
     * @throws \LogicException
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request) : JsonResponse
    {
        $credentials = $request->getContent();

        if (!$credentials) {
            return new JsonResponse(
                [
                    'message' => 'No credentials passed !'
                ],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse();
    }
}
