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
use Doctrine\ODM\MongoDB\DocumentManager;
use App\Events\Accounting\DeletedAccountingEvent;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class ApiAccountingManager
 *
 * @author Guillaume Loulier <contact@guillaumloulier.fr>
 */
class ApiAccountingManager
{
    /**
     * @var DocumentManager
     */
    private $documentManager;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * ApiAccountingManager constructor.
     *
     * @param DocumentManager           $documentManager
     * @param ValidatorInterface        $validator
     * @param SerializerInterface       $serializer
     * @param EventDispatcherInterface  $dispatcher
     */
    public function __construct(
        DocumentManager $documentManager,
        ValidatorInterface $validator,
        SerializerInterface $serializer,
        EventDispatcherInterface $dispatcher
    ) {
        $this->documentManager = $documentManager;
        $this->validator = $validator;
        $this->serializer = $serializer;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Return all the Accounting.
     *
     * @return string
     */
    public function getAccountings() : string
    {
        $data = $this->documentManager->getRepository(Accounting::class)
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
     * @param int $id           The id of the Accounting requested.
     *
     * @return string           The informations relatives to the Accounting (serialized).
     */
    public function getAccounting(int $id) : string
    {
        $data = $this->documentManager->getRepository(Accounting::class)
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

        $this->documentManager->persist($entity);
        $this->documentManager->flush();

        return $entity;
    }

    /**
     * @param int $id               The id of the Accounting to delete.
     *
     * @throws ApiJsonException     If the accounting doesn't exist.
     *
     * @return array                The success message send to the client.
     */
    public function deleteAccounting(int $id)
    {
        $accounting = $this->documentManager->getRepository(Accounting::class)
                                            ->findOneBy([
                                                'id' => $id
                                            ]);

        if (!$accounting) {
            throw new ApiJsonException(
                \sprintf(
                    'The identifier doesn\'t return any entry ! Given %d', $id
                )
            );
        }

        $this->documentManager->remove($accounting);

        $event = new DeletedAccountingEvent($accounting);
        $this->dispatcher->dispatch($event::NAME, $event);

        $this->documentManager->flush();

        return [
            'message' => 'Resource deleted !'
        ];
    }
}
