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

// Manager
use AppBundle\Managers\Web\WebAccountingManager;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class GetAccountingsAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @Route("/accountings", name="web_accountings")
 * @Method({"GET"})
 */
class GetAccountingsAction
{
    /** @var WebAccountingManager */
    private $manager;

    /** @var RequestStack */
    private $requestStack;

    /** @var EngineInterface */
    private $renderEngine;

    /**
     * GetAccountingsAction constructor.
     *
     * @param WebAccountingManager      $manager
     * @param RequestStack              $requestStack
     * @param EngineInterface           $renderEngine
     */
    public function __construct(
        WebAccountingManager $manager,
        RequestStack $requestStack,
        EngineInterface $renderEngine
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
