<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Events\Bills;
// Entity
use AppBundle\Entity\Bills;

// Core
use Symfony\Component\EventDispatcher\Event;

/**
 * Class DeletedBillsEvent
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class DeletedBillsEvent extends Event
{
    const NAME = 'bills.deleted';

    /** @var Bills */
    public $bills;

    /**
     * DeletedBillsEvent constructor.
     *
     * @param Bills $bills
     */
    public function __construct(
        Bills $bills
    ) {
        $this->bills = $bills;
    }

    /**
     * @return Bills
     */
    public function getBills()
    {
        return $this->bills;
    }
}
