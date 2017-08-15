<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Class ApiTokenAuthenticator
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ApiTokenAuthenticator extends AbstractGuardAuthenticator
{
    /**
     * {@inheritdoc}
     */
    public function getCredentials(Request $request) : array
    {
        if (!$token = $request->headers->get('X-AUTH-TOKEN')) {
            $token = null;
        }

        return [
            'token' => $token
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $apiKey = $credentials['token'];

        if (null === $apiKey) {
            return;
        }

        return $userProvider->loadUserByUsername($apiKey);
    }

    /**
     * {@inheritdoc}
     */
    public function checkCredentials($credentials, UserInterface $user) : bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception) : JsonResponse
    {
        return new JsonResponse(
            [
                'message' => strtr($exception->getMessage(), $exception->getMessageData())
            ],
            JsonResponse::HTTP_FORBIDDEN
        );
    }

    /**
     * {@inheritdoc}
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey) : null
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsRememberMe() : bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function start(Request $request, AuthenticationException $authException = null) : JsonResponse
    {
        return new JsonResponse(
            [
                'message' => 'Authentication required !'
            ],
            JsonResponse::HTTP_UNAUTHORIZED
        );
    }
}
