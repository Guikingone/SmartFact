<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Action\Api\Bills;

use Twig\Environment;
use App\Managers\API\ApiBillsManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class GetPersonalBillsAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class GetPersonalBillsAction
{
    /**
     * @var ApiBillsManager
     */
    private $manager;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * GetPersonalBillsAction constructor.
     *
     * @param ApiBillsManager       $manager
     * @param TokenStorageInterface $tokenStorage
     * @param Environment           $twig
     */
    public function __construct(
        ApiBillsManager $manager,
        TokenStorageInterface $tokenStorage,
        Environment $twig
    ) {
        $this->manager = $manager;
        $this->tokenStorage = $tokenStorage;
        $this->twig = $twig;
    }


    /**
     * @return Response
     */
    public function __invoke() : Response
    {
        $user = $this->tokenStorage->getToken()->getUser();

        $bills = $this->manager->getPersonalBills($user);

        return new Response(
            $bills,
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
