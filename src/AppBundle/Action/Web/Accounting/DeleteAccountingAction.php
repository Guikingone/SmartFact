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

// Core
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class DeleteAccountingAction
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @Route("/accounting/{id}/delete", name="web_accounting_delete")
 * @Method({"DELETE"})
 */
final class DeleteAccountingAction
{
    /** @var WebAccountingManager */
    private $manager;

    /** @var RequestStack */
    private $request;

    /** @var SessionInterface */
    private $session;

    /**
     * DeleteAccountingAction constructor.
     *
     * @param WebAccountingManager  $manager
     * @param RequestStack          $request
     * @param SessionInterface      $session
     */
    public function __construct(
        WebAccountingManager $manager,
        RequestStack $request,
        SessionInterface $session
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
