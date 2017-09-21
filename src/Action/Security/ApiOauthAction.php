<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Action\Security;

use App\Exceptions\ApiJsonException;
use App\Managers\API\ApiSecurityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * ApiOauthAction constructor.
     *
     * @param ApiSecurityManager    $securityManager
     */
    public function __construct(ApiSecurityManager $securityManager)
    {
        $this->securityManager = $securityManager;
    }

    /**
     * @param $request  Request
     *
     * @throws \InvalidArgumentException
     * @throws ApiJsonException
     *
     * @return Response
     */
    public function __invoke(Request $request) : Response
    {
        $headers = $request->request->all();

        $credentials = $this->securityManager->authenticateUserViaHeaders($headers);

        return new Response(
            \json_encode($credentials),
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
