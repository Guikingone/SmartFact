<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Action\Api\Notifications;

use App\Managers\API\ApiNotificationsManager;

// Core
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class DeleteNotificationsAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @Route("/users/{id}/notifications/delete", name="api_user_notifications_delete")
 * @Method({"DELETE"})
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
