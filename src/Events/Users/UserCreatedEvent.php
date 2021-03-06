<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Events\Users;

use App\Model\User;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class UserCreatedEvent
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class UserCreatedEvent extends Event
{
    const NAME = 'users.created';

    /**
     * @var User
     */
    public $user;

    /**
     * UserCreatedEvent constructor.
     *
     * @param User     $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
