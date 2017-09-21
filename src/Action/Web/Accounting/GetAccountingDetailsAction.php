<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Action\Web\Accounting;

use App\Managers\Web\WebAccountingManager;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class GetAccountingsByUserAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class GetAccountingDetailsAction
{
    /** @var WebAccountingManager */
    private $manager;

    /** @var RequestStack */
    private $requestStack;

    /** @var Environment */
    private $renderEngine;

    /**
     * GetAccountingDetailsAction constructor.
     *
     * @param WebAccountingManager      $manager
     * @param RequestStack              $requestStack
     * @param Environment               $engine
     */
    public function __construct(
        WebAccountingManager $manager,
        RequestStack $requestStack,
        Environment $engine
    ) {
        $this->manager = $manager;
        $this->requestStack = $requestStack;
        $this->renderEngine = $engine;
    }

    /**
     * @return Response
     */
    public function __invoke()
    {
        $id = $this->requestStack->getCurrentRequest()->get('id');

        $accounting = $this->manager->getAccountingDetails($id);

        return new Response(
            $this->renderEngine->render('accounting/accounting_details.html.twig', [
                'accounting' => $accounting
            ])
        );
    }
}
