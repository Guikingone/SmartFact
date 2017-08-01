<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Resolvers;

use App\Model\Accounting;

/**
 * Class AccountingResolver
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class AccountingResolver extends Accounting implements \JsonSerializable
{
    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
          'id' => $this->getId(),
          'name' => ucfirst($this->getName()),
          'address' => $this->getAddress(),
          'interlocutor' => ucfirst($this->getInterlocutor()),
          'phoneNumber' => $this->getPhoneNumber(),
          'email' => $this->getEmail()
        ];
    }
}
