<?php

declare(strict_types=1);

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Mutator\Interfaces;

use App\Models\Interfaces\NotificationInterface;

/**
 * Interface NotificationMutatorInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface NotificationMutatorInterface
{
    /**
     * @param \ArrayAccess $arguments    The arguments required to create a new Notification.
     *
     * @return NotificationInterface     The Notification which was created.
     */
    public function createNotification(\ArrayAccess $arguments): NotificationInterface;
}
