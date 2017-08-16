<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Schemas;

use GraphQL\Type\Definition\InterfaceType;

/**
 * Class AccountingSchema
 * 
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class AccountingSchema extends InterfaceType
{
    /**
     * @return array
     */
    public function build() : array
    {
        return [
            'name' => 'Accounting',
            'description' => '',
            'fields' => [

            ]
        ];
    }
}
