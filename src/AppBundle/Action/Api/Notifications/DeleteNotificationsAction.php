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

use AppBundle\Managers\API\ApiNotificationsManager;

// Core
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DeleteNotificationsAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @Route("/users/{id}/notifications/delete", name="api_user_notifications_delete")
 */
class DeleteNotificationsAction
{
    /** @var ApiNotificationsManager */
    private $manager;

    /** @var RequestStack */
    private $requestStack;

    /**
     * DeleteNotificationsAction constructor.
     *
     * @param ApiNotificationsManager   $manager
     * @param RequestStack              $requestStack
     */
    public function __construct(
        ApiNotificationsManager $manager,
        RequestStack $requestStack
    ) {
        $this->manager = $manager;
        $this->requestStack = $requestStack;
    }

    /**
     * @return JsonResponse
     */
    public function __invoke()
    {
        $this->manager->deleteUserNotifications(
            $this->requestStack->getCurrentRequest()->get('id')
        );

        return new JsonResponse(
            ['message' => 'Resource deleted.'],
            Response::HTTP_ACCEPTED
        );
    }
}