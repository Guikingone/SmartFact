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

namespace App\Resolver\Interfaces;

/**
 * Class NotificationResolverInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface NotificationResolverInterface
{
    /**
     * @param \ArrayAccess $arguments    The arguments needed to fetch Notifications.
     *
     * @return array                     The notifications found using the arguments.
     */
    public function getNotifications(\ArrayAccess $arguments): array;
}
