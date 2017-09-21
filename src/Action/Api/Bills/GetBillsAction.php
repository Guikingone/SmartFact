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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class GetBillsAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class GetBillsAction
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
     * GetBillsAction constructor.
     *
     * @param ApiBillsManager $manager
     * @param RequestStack $requestStack
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
        return new Response(
            $this->manager->getBills(),
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
