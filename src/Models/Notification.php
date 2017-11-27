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

namespace App\Models;

use App\Models\Interfaces\NotificationInterface;

/**
 * Class Notification
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
abstract class Notification implements NotificationInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * {@inheritdoc}
     */
    public function getId():? int
    {
        return $this->id;
    }
}
