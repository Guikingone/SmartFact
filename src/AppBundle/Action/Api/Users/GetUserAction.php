<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Action\Api\Users;

use AppBundle\Managers\API\ApiUserManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class GetUserAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @Route("/user/{id}", name="api_user")
 *
 * @Method({"GET"})
 */
final class GetUserAction
{
    /** @var ApiUserManager */
    private $manager;

    /** @var RequestStack */
    private $request;

    /**
     * GetUserAction constructor.
     *
     * @param ApiUserManager    $manager
     * @param RequestStack      $request
     */
    public function __construct(
        ApiUserManager $manager,
        RequestStack $request
    ) {
        $this->manager = $manager;
        $this->request = $request;
    }

    /**
     * @return Response
     */
    public function __invoke()
    {
        $id = $this->request->getCurrentRequest()->get('id');

        $data = $this->manager->getUserById($id);

        return new Response(
            $data,
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
