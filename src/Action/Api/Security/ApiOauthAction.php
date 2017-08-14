<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Action\Api\Security;

use App\Managers\API\ApiSecurityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class ApiOauthAction
 * 
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class ApiOauthAction
{
    /**
     * @var ApiSecurityManager
     */
    private $securityManager;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * ApiOauthAction constructor.
     *
     * @param ApiSecurityManager     $securityManager
     * @param RequestStack           $requestStack
     */
    public function __construct(
        ApiSecurityManager $securityManager,
        RequestStack $requestStack
    ) {
        $this->securityManager = $securityManager;
        $this->requestStack = $requestStack;
    }

    /**
     * @throws \InvalidArgumentException
     *
     * @return Response
     */
    public function __invoke() : Response
    {
        $headers = $this->requestStack->getCurrentRequest()->request->all();

        $credentials = $this->securityManager->authenticateUserViaHeaders($headers);

        return new Response(
            json_encode($credentials),
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
