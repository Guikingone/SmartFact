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

use App\Model\User;
use App\Exceptions\ApiJsonException;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

/**
 * Class ApiTokenUserProvider
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class ApiTokenUserProvider implements UserProviderInterface
{
    /**
     * @var DocumentManager
     */
    private $documentManager;

    /**
     * ApiTokenUserProvider constructor.
     *
     * @param DocumentManager     $documentManager
     */
    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    /**
     * @param string $apiToken         The api token.
     *
     * @throws ApiJsonException        If no user can be found using the given api token.
     *
     * @return string                  The username of the User linked to the api token.
     */
    public function findUserByApiToken(string $apiToken)
    {
        $entity = $this->documentManager->getRepository(User::class)
                                        ->findOneBy([
                                            'apiToken' => $apiToken
                                        ]);

        if (!$entity) {
            throw new ApiJsonException(
                \sprintf(
                    'No user can be found using this api token ! Given %s',
                    $apiToken
                )
            );
        }

        return $entity->getUsername();
    }

    /**
     * @param string $username          The username of the user to find.
     *
     * @return User                     The User linked to this username.
     */
    public function loadUserByUsername($username) : User
    {
        return $this->documentManager->getRepository(User::class)
                                     ->findOneBy([
                                         'username' => $username
                                     ]);
    }

    /**
     * @param UserInterface $user
     *
     * @throws UnsupportedUserException
     *
     * @return void
     */
    public function refreshUser(UserInterface $user) : void
    {
        throw new UnsupportedUserException(
            \sprintf(
                ''
            )
        );
    }

    /**
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class) : bool
    {
        return User::class === $class;
    }
}
