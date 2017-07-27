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

/**
 * Class GetAccountingsAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
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
