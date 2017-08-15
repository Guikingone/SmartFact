<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Providers;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class ApiKeyUserProvider
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class ApiKeyUserProvider implements UserProviderInterface
{
    /**
     * @var DocumentManager
     */
    private $documentManager;

    /**
     * ApiKeyUserProvider constructor.
     *
     * @param DocumentManager    $documentManager
     */
    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    public function loadUserByUsername($username)
    {

    }

    public function refreshUser(UserInterface $user)
    {
        // TODO: Implement refreshUser() method.
    }

    public function supportsClass($class)
    {
        // TODO: Implement supportsClass() method.
    }
}
