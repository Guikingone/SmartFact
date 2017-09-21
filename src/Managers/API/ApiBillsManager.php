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

use App\Model\Bills;
use App\Exceptions\ApiJsonException;
use Doctrine\ODM\MongoDB\DocumentManager;
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
     * @var DocumentManager
     */
    private $documentManager;

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
     * @param DocumentManager           $documentManager
     * @param SerializerInterface       $serializer
     * @param EventDispatcherInterface  $dispatcher
     */
    public function __construct(
        DocumentManager $documentManager,
        SerializerInterface $serializer,
        EventDispatcherInterface $dispatcher
    ) {
        $this->documentManager = $documentManager;
        $this->serializer = $serializer;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param string $userId
     *
     * @return string
     */
    public function getPersonalBills(string $userId) : string
    {
        $entries = $this->documentManager->getRepository(Bills::class)
                                         ->findBy([
                                             'user' => $userId
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
        $data = $this->documentManager->getRepository(Bills::class)
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
        $entity = $this->documentManager->getRepository(Bills::class)
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
        $entity = $this->documentManager->getRepository(Bills::class)
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

        $this->documentManager->remove($entity);
        $this->documentManager->flush();
    }
}
