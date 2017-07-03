<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Action\Api\Accounting;

use Symfony\Component\HttpFoundation\Response;
use AppBundle\Managers\API\ApiAccountingManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Class GetAccountingsAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @Route("/accountings", name="api_accountings")
 * @Method({"GET"})
 */
final class GetAccountingsAction
{
    /** @var ApiAccountingManager */
    private $manager;

    /**
     * GetAccountingsAction constructor.
     *
     * @param ApiAccountingManager $manager
     */
    public function __construct(
        ApiAccountingManager $manager
    ) {
        $this->manager = $manager;
    }

    /**
     * @return Response
     */
    public function __invoke()
    {
        return new Response(
            $this->manager->getAccountings(),
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
