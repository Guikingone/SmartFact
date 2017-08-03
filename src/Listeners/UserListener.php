<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Listeners;

use App\Events\Users\UserCreatedEvent;
use App\Events\Users\UserUpdatedEvent;

/**
 * Class UserListener
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class UserListener
{
    /**
     * @param UserCreatedEvent $event
     */
    public function onUserCreated(UserCreatedEvent $event)
    {
        $user = $event->getUser();

        if (!$user) {
            return;
        }

        $user->setStatus($user::CREATED);
    }

    /**
     * @param UserUpdatedEvent $event
     */
    public function onUserUpdated(UserUpdatedEvent $event)
    {
        $user = $event->getUser();

        if (!$user) {
            return;
        }

    }
}
