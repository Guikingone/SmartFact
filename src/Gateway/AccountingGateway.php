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

use App\Resolvers\AccountingResolver;

/**
 * Class AccountingGateway
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
abstract class AccountingGateway
{
    /**
     * @return AccountingResolver[]
     */
    public abstract function findAll();

    /**
     * @param int $accounting
     *
     * @return AccountingResolver
     */
    public abstract function find(int $accounting);

    /**
     * @param array $parameters
     *
     * @return AccountingResolver
     */
    public abstract function findOneBy(array $parameters);

    /**
     * @param array $data
     *
     * @return AccountingResolver
     */
    public abstract function insert(array $data);

    /**
     * @param array $data
     *
     * @return AccountingResolver
     */
    public abstract function update(array $data) : AccountingResolver;

    /**
     * @param array $data
     *
     * @return AccountingResolver
     */
    public abstract function patch(array $data) : AccountingResolver;

    /**
     * @param int $accounting
     *
     * @return bool
     */
    public abstract function delete(int $accounting);

    /**
     * @param array $result
     *
     * @return AccountingResolver
     */
    public abstract function buildObject(array $result) : AccountingResolver;
}
