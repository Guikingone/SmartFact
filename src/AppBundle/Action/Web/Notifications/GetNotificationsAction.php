<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Action\Web\Notifications;

// Manager
use AppBundle\Managers\Web\WebNotificationsManager;

// Core
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class GetNotificationsAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @Route("/user/{id}/notifications", name="web_user_notifications")
 * @Method({"GET"})
 */
class GetNotificationsAction
{
    /** @var WebNotificationsManager */
    private $manager;

    /** @var RequestStack */
    private $request;

    /** @var EngineInterface */
    private $renderEngine;

    /**
     * GetNotificationsAction constructor.
     *
     * @param WebNotificationsManager   $manager
     * @param RequestStack              $request
     * @param EngineInterface           $renderEngine
     */
    public function __construct(
        WebNotificationsManager $manager,
        RequestStack $request,
        EngineInterface $renderEngine
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
