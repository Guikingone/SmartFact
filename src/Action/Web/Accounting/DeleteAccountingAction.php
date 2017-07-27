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

// Core
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\SessionValueResolver;

/**
 * Class DeleteAccountingAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class DeleteAccountingAction
{
    /** @var WebAccountingManager */
    private $manager;

    /** @var RequestStack */
    private $request;

    /** @var SessionValueResolver */
    private $session;

    /**
     * DeleteAccountingAction constructor.
     *
     * @param WebAccountingManager  $manager
     * @param RequestStack          $request
     * @param SessionValueResolver  $session
     */
    public function __construct(
        WebAccountingManager $manager,
        RequestStack $request,
        SessionValueResolver $session
    ) {
        $this->manager = $manager;
        $this->request = $request;
        $this->session = $session;
    }

    /**
     * @return RedirectResponse
     */
    public function __invoke()
    {
        $id = $this->request->getCurrentRequest()->get('id');

        $this->manager->deleteAccounting($id);

        return new RedirectResponse('home');
    }
}
