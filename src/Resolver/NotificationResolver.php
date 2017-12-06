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

namespace App\Resolver;

use App\Resolver\Interfaces\NotificationResolverInterface;

/**
 * Class NotificationResolver
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class NotificationResolver implements NotificationResolverInterface
{
    /**
     * {@inheritdoc}
     */
    public function getNotifications(\ArrayAccess $arguments): array
    {
        // TODO: Implement getNotifications() method.
    }
}
