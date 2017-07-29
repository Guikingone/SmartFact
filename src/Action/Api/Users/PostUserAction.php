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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class PostUserAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class PostUserAction
{
    /**
     * @var ApiUserManager
     */
    private $manager;

    /**
     * @var RequestStack
     */
    private $request;

    /**
     * PostUserAction constructor.
     *
     * @param ApiUserManager    $manager
     * @param RequestStack      $request
     */
    public function __construct(
        ApiUserManager $manager,
        RequestStack $request
    ) {
        $this->manager = $manager;
        $this->request = $request;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke()
    {
        $data = $this->request->getCurrentRequest()->getContent();

        if (!$data) {
            return new JsonResponse(
                [
                    'error' => 'No data passed !',
                    'message' => 'No data passed !'
                ],
                Response::HTTP_BAD_REQUEST,
                ['Content-Type' => 'application/json']
            );
        }

        $this->manager->postUsers($data);

        return new JsonResponse(
            [
                'message' => 'Resource created.',
                'data' => [
                    $data
                ]
            ],
            Response::HTTP_CREATED
        );
    }
}
