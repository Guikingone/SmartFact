<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Action\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;

// Manager
use AppBundle\Managers\API\ApiNotificationsManager;

/**
 * Class GetNotificationsAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @Route("/user/{id}/notifications", name="api_user_notifications")
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
        $id = $this->requestStack->getCurrentRequest()->get('id');

        $notifications = $this->manager->getUserNotifications($id);

        return new Response(
            $notifications
        );
    }
}
