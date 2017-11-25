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

use App\Managers\API\ApiBillsManager;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetBillAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class GetBillAction
{
    /**
     * @var ApiBillsManager
     */
    private $manager;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * GetBillAction constructor.
     *
     * @param ApiBillsManager       $manager
     * @param RequestStack          $requestStack
     */
    public function __construct(
        ApiBillsManager $manager,
        RequestStack $requestStack
    ) {
        $this->manager = $manager;
        $this->requestStack = $requestStack;
    }

    /**
     * @throws \InvalidArgumentException
     *
     * @return Response
     */
    public function __invoke() : Response
    {
        $id = $this->requestStack->getCurrentRequest()->get('id');

        return new Response(
            $this->manager->getBillsById($id),
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
