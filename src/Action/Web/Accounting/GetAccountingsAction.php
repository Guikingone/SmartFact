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

// Manager
use App\Managers\Web\WebAccountingManager;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class GetAccountingsAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class GetAccountingsAction
{
    /** @var WebAccountingManager */
    private $manager;

    /** @var RequestStack */
    private $requestStack;

    /** @var Environment */
    private $renderEngine;

    /**
     * GetAccountingsAction constructor.
     *
     * @param WebAccountingManager      $manager
     * @param RequestStack              $requestStack
     * @param Environment               $renderEngine
     */
    public function __construct(
        WebAccountingManager $manager,
        RequestStack $requestStack,
        Environment $renderEngine
    ) {
        $this->manager = $manager;
        $this->requestStack = $requestStack;
        $this->renderEngine = $renderEngine;
    }

    /**
     * @return Response
     */
    public function __invoke()
    {
        $accountings = $this->manager->getAccountings();

        return new Response(
            $this->renderEngine->render('accounting/accountings.html.twig', [
                'accountings' => $accountings
            ])
        );
    }
}
