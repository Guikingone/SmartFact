<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Interfaces\SmartFactBillsInterface;

/**
 * Class Bills
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * @ORM\Table(name="_smartfact_user_bills")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BillsRepository")
 */
class Bills implements SmartFactBillsInterface
{
}
