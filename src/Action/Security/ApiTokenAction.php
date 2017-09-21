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
 * Class ApiTokenAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class ApiTokenAction
{
    /**
     * @var ApiSecurityManager
     */
    private $apiManager;

    /**
     * ApiTokenAction constructor.
     *
     * @param ApiSecurityManager    $manager
     */
    public function __construct(ApiSecurityManager $manager)
    {
        $this->apiManager = $manager;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws \LogicException
     * @throws ApiJsonException
     * @throws \InvalidArgumentException
     */
    public function __invoke(Request $request) : JsonResponse
    {
        /** @var array $data */
        $data = \json_decode($request->getContent(), true);

        if (!$data) {
            throw new ApiJsonException(
                \sprintf(
                    'No credentials passed, identification refused !'
                )
            );
        }

        $access = $this->apiManager->authenticateViaCredentials($data);

        return new JsonResponse(
            [
                'token' => $access
            ]
        );
    }
}
