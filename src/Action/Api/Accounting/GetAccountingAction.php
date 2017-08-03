<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Action\Api\Accounting;

use App\Managers\API\ApiAccountingManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class GetAccountingAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class GetAccountingAction
{
    /**
     * @var ApiAccountingManager
     */
    private $manager;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * GetAccountingAction constructor.
     *
     * @param ApiAccountingManager      $manager
     * @param RequestStack              $requestStack
     */
    public function __construct(
        ApiAccountingManager $manager,
        RequestStack $requestStack
    ) {
        $this->manager = $manager;
        $this->requestStack = $requestStack;
    }

    /**
     * @return Response
     */
    public function __invoke()
    {
        $id = $this->requestStack->getCurrentRequest()->get('id');

        $data = $this->manager->getAccounting($id);

        return new Response(
            $data,
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
