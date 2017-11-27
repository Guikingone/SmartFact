<?php

declare(strict_types=1);

/*
 * This file is part of the Smartfact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Models;

use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\ClientInterface;

/**
 * Class Image
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
abstract class Image implements ImageInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $extension;

    /**
     * @var string
     */
    protected $size;

    /**
     * @var string
     */
    protected $localPath;

    /**
     * @var string
     */
    protected $publicPath;

    /**
     * @var \DateTime
     */
    protected $uploadDate;

    /**
     * @var \DateTime
     */
    protected $modificationDate;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * {@inheritdoc}
     */
    public function getId():? int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtension():? string
    {
        return $this->extension;
    }

    /**
     * {@inheritdoc}
     */
    public function setExtension(string $extension)
    {
        $this->extension = $extension;
    }

    /**
     * {@inheritdoc}
     */
    public function getSize():? string
    {
        return $this->size;
    }

    /**
     * {@inheritdoc}
     */
    public function setSize(string $size)
    {
        $this->size = $size;
    }

    /**
     * {@inheritdoc}
     */
    public function getLocalPath():? string
    {
        return $this->localPath;
    }

    /**
     * {@inheritdoc}
     */
    public function setLocalPath(string $localPath)
    {
        $this->localPath = $localPath;
    }

    /**
     * {@inheritdoc}
     */
    public function getPublicPath(): string
    {
        return $this->publicPath;
    }

    /**
     * {@inheritdoc}
     */
    public function setPublicPath(string $publicPath)
    {
        $this->publicPath = $publicPath;
    }

    /**
     * {@inheritdoc}
     */
    public function getUploadDate(): string
    {
        return $this->uploadDate->format('D d-M-Y H:i:s');
    }

    /**
     * {@inheritdoc}
     */
    public function setUploadDate(\DateTime $uploadDate)
    {
        $this->uploadDate = $uploadDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getModificationDate():? string
    {
        return $this->modificationDate->format('D d-M-Y H:i:s');
    }

    /**
     * {@inheritdoc}
     */
    public function setModificationDate(\DateTime $modificationDate)
    {
        $this->modificationDate = $modificationDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser():? UserInterface
    {
        return $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * {@inheritdoc}
     */
    public function getClient():? ClientInterface
    {
        return $this->client;
    }

    /**
     * {@inheritdoc}
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }
}