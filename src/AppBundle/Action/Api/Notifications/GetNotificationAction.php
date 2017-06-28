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

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

// Manager
use AppBundle\Managers\API\ApiNotificationsManager;

/**
 * Class GetNotificationAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @Route("/user/{id}/notification/{notifId}", name="api_user_notification")
 *
 * @Method({"GET"})
 */
class GetNotificationAction
{
    /** @var ApiNotificationsManager */
    private $manager;

    /** @var RequestStack */
    private $requestStack;

    /**
     * GetNotificationAction constructor.
     *
     * @param ApiNotificationsManager $manager
     * @param RequestStack $requestStack
     */
    public function __construct(
        ApiNotificationsManager $manager,
        RequestStack $requestStack
    ) {
        $this->manager = $manager;
        $this->requestStack = $requestStack;
    }

    /**
     * @return Response
     */
    public function __invoke()
    {
        $data = $this->manager->getUserSingleNotification(
            $this->requestStack->getCurrentRequest()->get('id'),
            $this->requestStack->getCurrentRequest()->get('notifId')
        );

        return new Response(
            $data,
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
