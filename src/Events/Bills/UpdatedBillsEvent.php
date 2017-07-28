<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Events\Bills;

use App\Model\Bills;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class UpdatedBillsEvent
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UpdatedBillsEvent extends Event
{
    const NAME = 'bills.updated';

    /** @var Bills */
    public $bills;

    /**
     * UpdatedBillsEvent constructor.
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
