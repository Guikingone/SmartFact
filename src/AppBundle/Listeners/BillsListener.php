<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Listeners;

// Events
use AppBundle\Events\Bills\NewBillsEvent;
use AppBundle\Events\Bills\UpdatedBillsEvent;
use AppBundle\Events\Bills\DeletedBillsEvent;

/**
 * Class BillsListener
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class BillsListener
{
    /**
     * Link to the creation of a new Bills.
     *
     * @param NewBillsEvent $event
     */
    public function onBillsCreated(NewBillsEvent $event)
    {
        $bills = $event->getBills();
    }

    /**
     * Link to the update of the Bills.
     *
     * @param UpdatedBillsEvent $event
     */
    public function onBillsUpdated(UpdatedBillsEvent $event)
    {
        $bills = $event->getBills();
    }

    /**
     * Link to the deletion of a Bills.
     *
     * @param DeletedBillsEvent $event
     */
    public function onBillsDeleted(DeletedBillsEvent $event)
    {
        $bills = $event->getBills();
    }
}
