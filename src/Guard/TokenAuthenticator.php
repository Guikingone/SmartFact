<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Guard;

use App\Exceptions\ApiJsonException;
use App\Providers\ApiTokenUserProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;

/**
 * Class TokenAuthenticator
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class TokenAuthenticator extends AbstractGuardAuthenticator
{
    /**
     * @param Request $request      The actual request.
     *
     * @return array                The array who contain the token.
     */
    public function getCredentials(Request $request) : array
    {
        if (!$token = $request->headers->get('authorization')) {
            $token = null;
        }

        return [
            'token' => $token
        ];
    }

    /**
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     *
     * @throws ApiJsonException                         @see ApiTokenUserProvider::findUserByApiToken()
     *
     * @return \App\Model\User|null|UserInterface|void
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = $credentials['token'];

        if (null === $token) {
            return;
        }

        if ($userProvider instanceof ApiTokenUserProvider) {
            $username = $userProvider->findUserByApiToken($token);
        }

        return $userProvider->loadUserByUsername($username);
    }

    /**
     * @param mixed $credentials
     * @param UserInterface $user
     *
     * @return bool
     */
    public function checkCredentials($credentials, UserInterface $user) : bool
    {
        return true;
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey
     *
     * @return null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     *
     * @return JsonResponse
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception) : JsonResponse
    {
        return new JsonResponse(
            [
                'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
            ],
            JsonResponse::HTTP_FORBIDDEN
        );
    }

    /**
     * @return bool
     */
    public function supportsRememberMe() : bool
    {
        return false;
    }

    /**
     * @param Request $request
     * @param AuthenticationException|null $authException
     *
     * @return JsonResponse
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

    /**
     * @param UserInterface $user
     * @param string $providerKey
     *
     * @throws \InvalidArgumentException
     *
     * @return PostAuthenticationGuardToken
     */
    public function createAuthenticatedToken(UserInterface $user, $providerKey) : PostAuthenticationGuardToken
    {
        return new PostAuthenticationGuardToken(
            $user,
            $providerKey,
            [$user->getRoles()]
        );
    }
}
