<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Managers\API;

use App\Model\Accounting;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class ApiAccountingManager
 *
 * @author Guillaume Loulier <contact@guillaumloulier.fr>
 */
class ApiAccountingManager
{
    /** @var SerializerInterface */
    private $serializer;

    /** @var EntityManagerInterface */
    private $doctrine;

    /**
     * ApiAccountingManager constructor.
     *
     * @param SerializerInterface       $serializer
     * @param EntityManagerInterface    $doctrine
     */
    public function __construct(
        SerializerInterface $serializer,
        EntityManagerInterface $doctrine
    ) {
        $this->serializer = $serializer;
        $this->doctrine = $doctrine;
    }

    /**
     * Return all the Accounting.
     *
     * @return string
     */
    public function getAccountings() : string
    {
        $data = $this->doctrine->getRepository(Accounting::class)
                               ->findAll();

        return $this->serializer->serialize(
            $data,
            'json',
            ['groups' => ['accouting']]
        );
    }

    /**
     * Return a single Accounting.
     *
     * @param int $id
     *
     * @return string
     */
    public function getAccounting(int $id) : string
    {
        $data = $this->doctrine->getRepository(Accounting::class)
                               ->findOneBy([
                                   'id' => $id
                               ]);

        return $this->serializer->serialize(
            $data,
            'json',
            ['groups' => ['accounting']]
        );
    }

    /**
     * @param int $id
     */
    public function deleteAccounting(int $id)
    {
        $accounting = $this->doctrine->getRepository(Accounting::class)
                                     ->findOneBy([
                                         'id' => $id
                                     ]);

        $this->doctrine->remove($accounting);
        $this->doctrine->flush();
    }
}
