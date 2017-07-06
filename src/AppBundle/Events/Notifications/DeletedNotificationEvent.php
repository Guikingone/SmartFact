<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Events\Notifications;

use AppBundle\Entity\Notifications;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class DeletedNotificationEvent
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class DeletedNotificationEvent extends Event
{
    const NAME = 'notification.deleted';

    /** @var Notifications */
    public $notification;

    /**
     * DeletedNotificationEvent constructor.
     *
     * @param Notifications     $notification
     */
    public function __construct(
        Notifications $notification
    ) {
        $this->notification = $notification;
    }


    public function getNotification()
    {
        return $this->notification;
    }
}
