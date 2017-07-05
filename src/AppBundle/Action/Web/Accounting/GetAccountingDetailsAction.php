<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Action\Web\Accounting;

use Symfony\Component\HttpFoundation\Response;
use AppBundle\Managers\Web\WebAccountingManager;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class GetAccountingsByUserAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @Route("/accounting/{id}/details", name="web_accounting_details")
 * @Method({"GET"})
 *
 */
class GetAccountingDetailsAction
{
    /** @var WebAccountingManager */
    private $manager;

    /** @var RequestStack */
    private $requestStack;

    /** @var EngineInterface */
    private $renderEngine;

    /**
     * GetAccountingDetailsAction constructor.
     *
     * @param WebAccountingManager      $manager
     * @param RequestStack              $requestStack
     * @param EngineInterface           $engine
     */
    public function __construct(
        WebAccountingManager $manager,
        RequestStack $requestStack,
        EngineInterface $engine
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
