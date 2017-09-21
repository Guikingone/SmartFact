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
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PutAccountingAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class PutAccountingAction
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
     * PutAccountingAction constructor.
     *
     * @param ApiAccountingManager     $manager
     * @param RequestStack             $requestStack
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
    public function __invoke() : Response
    {
        $id = $this->requestStack->getCurrentRequest()->attributes->get('id');

        $data = $this->requestStack->getCurrentRequest()->getContent();

        $entity = $this->manager->putAccounting($data, $id);

        if (\is_array($entity) && \array_key_exists('resource', $entity)) {
            return new Response(
                $entity['resource'],
                Response::HTTP_SEE_OTHER,
                ['Content-Type' => 'application/json']
            );
        }

        return new Response(
            $entity,
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
