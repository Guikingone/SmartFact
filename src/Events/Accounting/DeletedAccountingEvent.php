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

use App\Model\Accounting;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class DeletedAccountingEvent
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class DeletedAccountingEvent extends Event
{
    const NAME = 'accounting.deleted';

    /** @var Accounting */
    public $accounting;

    /**
     * DeletedAccountingEvent constructor.
     *
     * @param Accounting    $accounting
     */
    public function __construct(
        Accounting $accounting
    ) {
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
