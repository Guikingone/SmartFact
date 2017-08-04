<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Listeners\Users;

use App\Events\Users\UserCreatedEvent;
use App\Events\Users\UserUpdatedEvent;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserListener
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class UserListener
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * UserListener constructor.
     *
     * @param UserPasswordEncoderInterface      $passwordEncoder
     * @param \Swift_Mailer                     $mailer
     */
    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        \Swift_Mailer $mailer
    ) {
        $this->passwordEncoder = $passwordEncoder;
        $this->mailer = $mailer;
    }


    /**
     * @param UserCreatedEvent $event
     */
    public function onUsersCreated(UserCreatedEvent $event)
    {
        $user = $event->getUser();

        if (!$user) {
            return;
        }

        $user->setCreatedAt(new \DateTime());
        $user->setStatus($user::CREATED);
        $password = $this->passwordEncoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);
        $user->setValidated(false);
    }

    /**
     * @param UserUpdatedEvent $event
     */
    public function onUsersUpdated(UserUpdatedEvent $event)
    {
        $user = $event->getUser();

        if (!$user) {
            return;
        }

    }
}
