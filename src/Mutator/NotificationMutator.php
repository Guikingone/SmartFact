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

namespace App\Mutator;

use App\Models\Interfaces\NotificationInterface;
use App\Mutator\Interfaces\NotificationMutatorInterface;

/**
 * Class NotificationMutator
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class NotificationMutator implements NotificationMutatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function createNotification(\ArrayAccess $arguments): NotificationInterface
    {
        // TODO: Implement createNotification() method.
    }
}
