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
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class PostBillsAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class PostBillsAction
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
     * PostBillsAction constructor.
     *
     * @param ApiBillsManager     $manager
     * @param RequestStack        $requestStack
     */
    public function __construct(
        ApiBillsManager $manager,
        RequestStack $requestStack
    ) {
        $this->manager = $manager;
        $this->requestStack = $requestStack;
    }

    public function __invoke()
    {
        $data = $this->requestStack->getCurrentRequest()->getContent();

        $object = $this->manager->postBills($data);
    }
}
