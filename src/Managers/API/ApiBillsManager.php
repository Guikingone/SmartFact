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

use App\Model\User;
use App\Model\Bills;
use Doctrine\ORM\EntityManager;
use App\Exceptions\ApiJsonException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class ApiBillsManager
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
final class ApiBillsManager
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * ApiBillsManager constructor.
     *
     * @param EntityManager             $entityManager
     * @param SerializerInterface       $serializer
     * @param EventDispatcherInterface  $dispatcher
     */
    public function __construct(
        EntityManager $entityManager,
        SerializerInterface $serializer,
        EventDispatcherInterface $dispatcher
    ) {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param string $userId
     *
     * @return string
     */
    public function getPersonalBills(User $user) : string
    {
        $entries = $this->entityManager->getRepository(Bills::class)
                                         ->findBy([
                                             'user' => $user
                                         ]);

        return $this->serializer->serialize(
            $entries,
            'json',
            ['groups' => ['personal']]
        );
    }

    /**
     * @return string        The resources found.
     */
    public function getBills() : string
    {
        $data = $this->entityManager->getRepository(Bills::class)
                                      ->findAll();

        return $this->serializer->serialize(
            $data,
            'json',
            ['groups' => ['bills']]
        );
    }

    /**
     * @param int $id                  The id of the resource.
     *
     * @throws ApiJsonException        If no resource are found.
     *
     * @return string                  The resource found.
     */
    public function getBillsById(int $id) : string
    {
        $entity = $this->entityManager->getRepository(Bills::class)
                                        ->findOneBy([
                                            'id' => $id
                                        ]);

        if (!$entity) {
            throw new ApiJsonException(
                \sprintf(
                    'No resource found using the identifier %d', $id
                )
            );
        }

        return $this->serializer->serialize(
            $entity,
            'json'
        );
    }

    /**
     * @param array $data
     */
    public function postBills(array $data)
    {

    }

    /**
     * @param int $id        The id of the resource.
     *
     * @throws ApiJsonException
     */
    public function deleteBills(int $id)
    {
        $entity = $this->entityManager->getRepository(Bills::class)
                                        ->findOneBy([
                                            'id' => $id
                                        ]);

        if (!$entity) {
            throw new ApiJsonException(
                \sprintf(
                    'No resource found using the identifier %d', $id
                )
            );
        }

        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}
