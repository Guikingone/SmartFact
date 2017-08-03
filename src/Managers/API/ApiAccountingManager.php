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
use App\Exceptions\ApiJsonException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ApiAccountingManager
 *
 * @author Guillaume Loulier <contact@guillaumloulier.fr>
 */
class ApiAccountingManager
{
    /**
     * @var EntityManagerInterface
     */
    private $doctrine;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * ApiAccountingManager constructor.
     *
     * @param EntityManagerInterface        $doctrine
     * @param ValidatorInterface            $validator
     * @param SerializerInterface           $serializer
     */
    public function __construct(
        EntityManagerInterface $doctrine,
        ValidatorInterface $validator,
        SerializerInterface $serializer
    ) {
        $this->doctrine = $doctrine;
        $this->validator = $validator;
        $this->serializer = $serializer;
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
     * Return a single Accounting using his id.
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
     * @param array $data
     *
     * @throws ApiJsonException
     *
     * @return array|object
     */
    public function postAccounting(array $data)
    {
        if (!$data) {
            throw new ApiJsonException(
                \sprintf(
                    ''
                )
            );
        }

        $errors = $this->validator->validate($data);

        if ($errors) {
            return [
                'errors' => $errors
            ];
        }

        $entity = $this->serializer->deserialize(
            $data,
            Accounting::class,
            'json'
        );

        $this->doctrine->persist($entity);
        $this->doctrine->flush();

        return $entity;
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
