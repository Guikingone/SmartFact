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
 * Class PostAccountingAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class PostAccountingAction
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
     * PostAccountingAction constructor.
     *
     * @param ApiAccountingManager        $manager
     * @param RequestStack                $requestStack
     */
    public function __construct(
        ApiAccountingManager $manager,
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
    public function __invoke()
    {
        $data = \json_decode(
            $this->requestStack->getCurrentRequest()->getContent(),
            true
        );

        $entry = $this->manager->postAccounting($data);

        return new Response(
            $entry,
            Response::HTTP_CREATED,
            ['Content-Type' => 'application/json']
        );
    }
}
