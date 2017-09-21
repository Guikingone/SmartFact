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
 * Class NewBillsEvent
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class NewBillsEvent extends Event
{
    const NAME = 'bills.created';

    /** @var Bills */
    public $bills;

    /**
     * NewBillsEvent constructor.
     *
     * @param Bills $bills
     */
    public function __construct(
        Bills $bills
    ) {
        $this->bills = $bills;
    }

    public function getBills()
    {
        return $this->bills;
    }
}
