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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class PatchAccountingAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class PatchAccountingAction
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
     * PatchAccountingAction constructor.
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
     * @return JsonResponse
     */
    public function __invoke() : JsonResponse
    {
        $id = $this->requestStack->getCurrentRequest()->query->get('id');

        $data = $this->requestStack->getCurrentRequest()->getContent();

        $this->manager->patchAccounting($data, $id);

        return new JsonResponse();
    }
}
