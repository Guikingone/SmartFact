<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Gateway;

use App\Model\Accounting;

/**
 * Class AccountingGateway
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
abstract class AccountingGateway
{
    /**
     * @return Accounting[]
     */
    public abstract function findAll();

    /**
     * @param int $accounting
     *
     * @return Accounting
     */
    public abstract function find(int $accounting);

    /**
     * @param array $parameters
     *
     * @return Accounting
     */
    public abstract function findOneBy(array $parameters);

    /**
     * @param array $data
     *
     * @return Accounting
     */
    public abstract function insert(array $data);

    /**
     * @param array $data
     *
     * @return Accounting
     */
    public abstract function update(array $data);

    /**
     * @param array $data
     *
     * @return Accounting
     */
    public abstract function patch(array $data);

    /**
     * @param int $accounting
     *
     * @return bool
     */
    public abstract function delete(int $accounting);

    /**
     * @param array $result
     *
     * @return Accounting
     */
    public abstract function buildObject(array $result);
}
