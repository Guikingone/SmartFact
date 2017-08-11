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
use App\Events\Accounting\PostedAccountingEvent;
use App\Events\Accounting\UpdatedAccountingEvent;
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
     * @return string           All the accounting stored.
     */
    public function getAccountings() : string
    {
        $data = $this->documentManager->getRepository(Accounting::class)
                                      ->findAll();

        return $this->serializer->serialize(
            $data,
            'json',
            ['groups' => ['accounting']]
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
     * @param array $data         The data passed for instantiating.
     *
     * @throws ApiJsonException   Ff no data are passed.
     *
     * @return array|object       The representation of the resource created.
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

        $clone = $this->documentManager->getRepository(Accounting::class)
                                       ->findOneBy([
                                           'name' => $entity->getName()
                                       ]);

        if ($clone) {
            return [
                'message' => 'Resource already exist !',
                'resource' => $clone
            ];
        }

        $event = new PostedAccountingEvent($entity);
        $this->dispatcher->dispatch($event::NAME, $event);

        $this->documentManager->persist($entity);
        $this->documentManager->flush();

        return $entity;
    }

    /**
     * @param string $data          he date passed to update the entity.
     * @param int $id               The id of the resource to update.
     *
     * @throws ApiJsonException     If no resource is found.
     *
     * @return array|string|Accounting
     */
    public function putAccounting(string $data, int $id)
    {
        $entity = $this->documentManager->getRepository(Accounting::class)
                                        ->findOneBy([
                                            'id' => $id
                                        ]);

        if (!$entity) {
            $accounting = $this->serializer->deserialize(
                $data,
                Accounting::class,
                'json'
            );

            $clone = $this->documentManager->getRepository(Accounting::class)
                                           ->findOneBy([
                                               'name' => $accounting->getName()
                                           ]);

            if ($clone) {
                return [
                    'message' => 'Resource already exist !',
                    'resource' => $this->serializer->serialize(
                        $clone,
                        'json'
                    )
                ];
            }

            $event = new PostedAccountingEvent($accounting);
            $this->dispatcher->dispatch($event::NAME, $event);

            $this->documentManager->persist($accounting);
            $this->documentManager->flush();

            return $this->serializer->serialize(
                $accounting,
                'json'
            );
        }

        $this->serializer->deserialize(
            $data,
            $entity,
            'json'
        );

        $event = new UpdatedAccountingEvent($entity);
        $this->dispatcher->dispatch($event::NAME, $event);

        $this->documentManager->flush();

        return $entity;
    }

    /**
     * @param array $data
     * @param int $id
     */
    public function patchAccounting(array $data, int $id)
    {
        $entity = $this->documentManager->getRepository(Accounting::class)
                                        ->findOneBy([
                                            'id' => $id
                                        ]);

        if (!$entity) {

        }

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
