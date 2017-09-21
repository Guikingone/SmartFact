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

use App\Managers\API\ApiUserManager;
use App\Exceptions\ApiJsonException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PatchUserAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class PatchUserAction
{
    /**
     * @var ApiUserManager
     */
    private $manager;

    /**
     * PatchUserAction constructor.
     *
     * @param ApiUserManager     $manager
     */
    public function __construct(ApiUserManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param Request $request
     *
     * @throws \LogicException
     * @throws ApiJsonException
     * @throws \InvalidArgumentException
     *
     * @return Response
     */
    public function __invoke(Request $request) : Response
    {
        $identifier = $request->get('id');

        $patch = $request->getContent();

        $action = $this->manager->patchUsers($identifier, $patch);

        return new Response(
            $action,
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
