<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Managers\Web;

use App\Model\User;
use App\Model\Accounting;
use App\Form\Type\Accounting\NewAccountingType;
use App\Events\Accounting\PostedAccountingEvent;
use App\Events\Accounting\UpdatedAccountingEvent;
use App\Events\Accounting\DeletedAccountingEvent;
use Doctrine\ORM\EntityManager;
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
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var FormFactoryInterface
     */
    private $form;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * WebAccountingManager constructor.
     *
     * @param EntityManager             $entityManager
     * @param FormFactoryInterface      $form
     * @param EventDispatcherInterface  $eventDispatcher
     */
    public function __construct(
        EntityManager $entityManager,
        FormFactoryInterface $form,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->entityManager = $entityManager;
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
        return $this->entityManager->getRepository(Accounting::class)
                                     ->findAll();
    }

    /**
     * Return the details of a single Accounting.
     *
     * @param int $id                               The id of the Accounting.
     *
     * @throws \InvalidArgumentException            If the identifier doesn't exist.
     *
     * @return Accounting[]|array
     */
    public function getAccountingDetails($id)
    {
        $accounting =  $this->entityManager->getRepository(Accounting::class)
                                             ->findBy([
                                                 'id' => $id
                                             ]);

        if (!$accounting) {
            throw new \InvalidArgumentException(
                \sprintf(
                    'This identifier doesn\'t exist !
                            Given %s', $id
                )
            );
        }

        return $accounting;
    }

    /**
     * Allow to create a new Accounting.
     *
     * @param Request $request                      The Request who contain the data.
     *
     * @return \Symfony\Component\Form\FormView     The form to expose.
     */
    public function postAccounting($request)
    {
        $accounting = new Accounting();

        $form = $this->form->create(NewAccountingType::class, $accounting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $event = new PostedAccountingEvent($accounting);
            $this->eventDispatcher->dispatch(
                PostedAccountingEvent::NAME,
                $event
            );

            $this->entityManager->persist($accounting);
            $this->entityManager->flush();
        }

        return $form->createView();
    }

    /**
     * Allow to update a Accounting using his id.
     *
     * @param int $id                                   The id of the Accounting to update.
     * @param Request $request                          The request who contains the data.
     *
     * @throws \LogicException                          Thrown if the id doesn't return a Accounting.
     *
     * @return \Symfony\Component\Form\FormView         The form to expose.
     */
    public function updateAccounting($id, $request)
    {
        $accounting = $this->entityManager->getRepository(Accounting::class)
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

            $this->entityManager->flush();
        }

        return $form->createView();
    }

    /**
     * Allow to remove the relation between an User and an Accounting.
     *
     * @param int $user                     The id of the User.
     * @param int $id                       The id of the Accounting.
     *
     * @throws \InvalidArgumentException    If the values aren't integers.
     * @throws \LogicException              If the User isn't found.
     * @throws \LogicException              If the Accounting isn't found.
     */
    public function removeAccountingUserRelation($user, $id)
    {
        if ((!is_int($user)) || !is_int($id)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'The values MUST be integers,
                            Given %s',
                    gettype([$user, $id])
                )
            );
        }

        $usr = $this->entityManager->getRepository(User::class)
                                     ->findOneBy([
                                         'id' => $user
                                     ]);

        if (!$usr) {
            throw new \LogicException(
                sprintf(
                    'A User must be found in order to go further !'
                )
            );
        }

        $accounting = $this->entityManager->getRepository(Accounting::class)
                                            ->findOneBy([
                                                'users' => $usr,
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

        $event = new DeletedAccountingEvent($accounting);
        $this->eventDispatcher->dispatch(
            DeletedAccountingEvent::NAME,
            $event
        );

        $accounting->removeUser($usr);

        $this->entityManager->flush();
    }

    /**
     * Allow to delete a Accounting using his id.
     *
     * @param int $id                           The id of the Accounting.
     *
     * @throws \InvalidArgumentException        If the argument aren't valid.
     * @throws \LogicException                  If the Accounting isn't found.
     */
    public function deleteAccounting($id)
    {
        if (!is_int($id)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'The value must be an integer !
                            Given %s',
                    gettype($id)
                )
            );
        }

        $accounting = $this->entityManager->getRepository(Accounting::class)
                                            ->findOneBy([
                                                'id' => $id
                                            ]);

        if (!$accounting) {
            throw new \LogicException(
                sprintf(
                    'An Accounting must be found !
                            Please check your identifiers.'
                )
            );
        }

        $this->entityManager->remove($accounting);
        $this->entityManager->flush();
    }
}
