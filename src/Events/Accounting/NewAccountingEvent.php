<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Events\Accounting;

// Entity
use App\Model\Accounting;

// Core
use Symfony\Component\EventDispatcher\Event;

/**
 * Class NewAccountingEvent
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class NewAccountingEvent extends Event
{
    const NAME = 'accounting.created';

    /** @var Accounting */
    public $accounting;

    /**
     * NewAccountingEvent constructor.
     *
     * @param Accounting $accounting
     */
    public function __construct($accounting)
    {
        $this->accounting = $accounting;
    }

    /**
     * @return Accounting
     */
    public function getAccounting()
    {
        return $this->accounting;
    }
}
