<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Action\Api\Security;

use App\Managers\API\ApiUserManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class ApiTokenAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class ApiTokenAction
{
    /**
     * @var ApiUserManager
     */
    private $apiManager;

    /**
     * @var RequestStack
     */
    private $request;

    /**
     * ApiTokenAction constructor.
     *
     * @param ApiUserManager    $manager
     * @param RequestStack      $request
     */
    public function __construct(
        ApiUserManager $manager,
        RequestStack $request
    ) {
        $this->apiManager = $manager;
        $this->request = $request;
    }

    /**
     * @throws \InvalidArgumentException
     *
     * @return JsonResponse
     */
    public function __invoke()
    {
        /** @var array $data */
        $data = json_decode($this->request->getCurrentRequest()->getContent(), true);

        $access = $this->apiManager->authenticateUser($data);

        if (!$access) {
            return new JsonResponse(
                [
                    'message' => 'Authentication refused !'
                ]
            );
        }

        return new JsonResponse(
            [
                'token' => $access
            ]
        );
    }
}
