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

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;

// Manager
use App\Managers\API\ApiNotificationsManager;

/**
 * Class GetNotificationsAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class GetNotificationsAction
{
    /** @var ApiNotificationsManager */
    private $manager;

    /** @var RequestStack */
    private $requestStack;

    /**
     * GetNotificationsAction constructor.
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
        $notifications = $this->manager->getUserNotifications(
            $this->requestStack->getCurrentRequest()->get('id')
        );

        return new Response(
            $notifications,
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
