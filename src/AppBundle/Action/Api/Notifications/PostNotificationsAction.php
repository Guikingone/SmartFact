<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Action\Api\Notifications;

// Core
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

// Manager
use AppBundle\Managers\API\ApiNotificationsManager;

/**
 * Class PostNotificationsAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class PostNotificationsAction
{
    /** @var ApiNotificationsManager */
    private $manager;

    /** @var RequestStack */
    private $request;

    /**
     * PostNotificationsAction constructor.
     *
     * @param ApiNotificationsManager   $manager
     * @param RequestStack              $requestStack
     */
    public function __construct(
        ApiNotificationsManager $manager,
        RequestStack $requestStack
    ) {
        $this->manager = $manager;
        $this->request = $requestStack;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke()
    {
        $data = $this->request->getCurrentRequest()->getContent();

        return new JsonResponse(
            $this->manager->postUserNotification($data),
            Response::HTTP_CREATED
        );
    }
}
