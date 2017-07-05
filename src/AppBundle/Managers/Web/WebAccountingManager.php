<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Managers\Web;

// Entity
use AppBundle\Entity\Accounting;

// Event
use AppBundle\Events\NewAccountingEvent;
use AppBundle\Events\UpdatedAccountingEvent;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Form\Type\NewAccountingType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class WebAccountingManager
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class WebAccountingManager
{
    /** @var EntityManagerInterface */
    private $doctrine;

    /** @var FormFactoryInterface */
    private $form;

    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /**
     * WebAccountingManager constructor.
     *
     * @param EntityManagerInterface $doctrine
     * @param FormFactoryInterface $form
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        FormFactoryInterface $form,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->doctrine = $doctrine;
        $this->form = $form;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Return all the Accountings.
     *
     * @return Accounting[]|array
     */
    public function getAccountings()
    {
        return $this->doctrine->getRepository(Accounting::class)
                              ->findAll();
    }

    /**
     * Return the details of a single Accounting.
     *
     * @param int $id
     *
     * @return Accounting[]|array
     */
    public function getAccountingDetails($id)
    {
        return $this->doctrine->getRepository(Accounting::class)
                              ->findBy([
                                  'id' => $id
                              ]);
    }

    /**
     * Allow to create a new Accounting.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\Form\FormView
     */
    public function postAccounting($request)
    {
        $accounting = new Accounting();

        $form = $this->form->create(NewAccountingType::class, $accounting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $event = new NewAccountingEvent($accounting);
            $this->eventDispatcher->dispatch(
                NewAccountingEvent::NAME,
                $event
            );

            $this->doctrine->persist($accounting);
            $this->doctrine->flush();
        }

        return $form->createView();
    }

    /**
     * Allow to update a Accounting using his id.
     *
     * @param int $id           The id of the Accounting to update.
     * @param Request $request  The request who contains the data.
     *
     * @return \Symfony\Component\Form\FormView
     */
    public function updateAccounting($id, $request)
    {
        $accounting = $this->doctrine->getRepository(Accounting::class)
                                     ->findOneBy([
                                         'id' => $id
                                     ]);

        if (!$accounting) {
            throw new \LogicException(
                sprintf(
                    'This identifier doesn\'t exist !
                            Given %s', $id
                )
            );
        }

        $form = $this->form->create(NewAccountingType::class, $accounting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $event = new UpdatedAccountingEvent($accounting);
            $this->eventDispatcher->dispatch(
                UpdatedAccountingEvent::NAME,
                $event
            );

            $this->doctrine->flush();
        }

        return $form->createView();
    }
}
