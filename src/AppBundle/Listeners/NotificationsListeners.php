<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Listeners;

// Events
use AppBundle\Events\Notifications\PostedNotificationEvent;
use AppBundle\Events\Notifications\DeletedNotificationEvent;

// Core
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class NotificationsListeners
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class NotificationsListeners
{
    /** @var SessionInterface */
    private $session;

    /** @var \Swift_Mailer */
    private $mailer;

    /**
     * NotificationsListeners constructor.
     *
     * @param SessionInterface $session
     * @param \Swift_Mailer $mailer
     */
    public function __construct(
        SessionInterface $session,
        \Swift_Mailer $mailer
    ) {
        $this->session = $session;
        $this->mailer = $mailer;
    }

    /**
     * @param DeletedNotificationEvent $event
     */
    public function onDeletedNotification(DeletedNotificationEvent $event)
    {
        $notification = $event->getNotification();

        if (!$notification) {
            return;
        }

    }
}
