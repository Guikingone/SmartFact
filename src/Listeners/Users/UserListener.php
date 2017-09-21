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

use Twig\Environment;
use App\Events\Users\UserCreatedEvent;
use App\Events\Users\UserUpdatedEvent;
use App\Events\Users\UserValidatedEvent;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserListener
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class UserListener
{
    /**
     * @var Environment
     */
    private $twig;

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
     * @param Environment                   $twig
     * @param UserPasswordEncoderInterface  $passwordEncoder
     * @param \Swift_Mailer                 $mailer
     */
    public function __construct(
        Environment $twig,
        UserPasswordEncoderInterface $passwordEncoder,
        \Swift_Mailer $mailer
    ) {
        $this->twig = $twig;
        $this->passwordEncoder = $passwordEncoder;
        $this->mailer = $mailer;
    }

    /**
     * @param UserCreatedEvent $event
     *
     * @throws \Twig_Error_Loader       @see Environment::render()
     * @throws \Twig_Error_Runtime      @see Environment::render()
     * @throws \Twig_Error_Syntax       @see Environment::render()
     */
    public function onUsersCreated(UserCreatedEvent $event) : void
    {
        $entity = $event->getUser();

        if (!$entity) {
            return;
        }

        $password = $this->passwordEncoder->encodePassword($entity, $entity->getPlainPassword());
        $entity->setPassword($password);

        $token = \uniqid('_token', true);
        $entity->setToken($token);

        $message = (new \Swift_Message())
                    ->setFrom('')
                    ->setTo($entity->getEmail())
                    ->setSubject('SmartFact - User registration')
                    ->setDate(new \DateTime())
                    ->setBody(
                        $this->twig->render('mails/create_account.html.twig'),
                        'text/html'
                    );

        $this->mailer->send($message);
    }

    /**
     * @param UserValidatedEvent $event
     */
    public function onUserValidated(UserValidatedEvent $event) : void
    {
        $user = $event->getUser();

        if ($user) {
            return;
        }
    }

    /**
     * @param UserUpdatedEvent $event
     */
    public function onUsersUpdated(UserUpdatedEvent $event) : void
    {
        $user = $event->getUser();

        if (!$user) {
            return;
        }
    }
}
