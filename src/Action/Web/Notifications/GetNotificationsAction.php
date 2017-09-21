<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Action\Web\Notifications;

// Manager
use App\Managers\Web\WebNotificationsManager;

// Core
use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class GetNotificationsAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class GetNotificationsAction
{
    /** @var WebNotificationsManager */
    private $manager;

    /** @var RequestStack */
    private $request;

    /** @var Environment */
    private $renderEngine;

    /**
     * GetNotificationsAction constructor.
     *
     * @param WebNotificationsManager   $manager
     * @param RequestStack              $request
     * @param Environment               $renderEngine
     */
    public function __construct(
        WebNotificationsManager $manager,
        RequestStack $request,
        Environment $renderEngine
    ) {
        $this->manager = $manager;
        $this->request = $request;
        $this->renderEngine = $renderEngine;
    }

    /**
     * @return Response
     */
    public function __invoke()
    {
        $user = $this->request->getCurrentRequest()->get('id');

        $notifications = $this->manager->getNotificationsByUser($user);

        return new Response(
            $this->renderEngine->render('notifications/user_notifications.html.twig', [
                'notifications' => $notifications
            ])
        );
    }
}
