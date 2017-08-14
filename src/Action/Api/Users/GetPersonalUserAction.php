<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Action\Api\Users;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class GetPersonalUserAction
 * 
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class GetPersonalUserAction
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * GetPersonalUserAction constructor.
     *
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @throws \InvalidArgumentException
     *
     * @return Response
     */
    public function __invoke() : Response
    {
        $headers = $this->requestStack->getCurrentRequest()->headers->all();

        var_dump($headers);

        return new Response(
            '',
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
