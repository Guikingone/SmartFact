<?php

declare(strict_types=1);

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Builders;

use App\Interactors\ImageInteractor;
use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\ClientInterface;
use App\Models\Interfaces\CompanyInterface;
use App\Builders\Interfaces\ImageBuilderInterface;

/**
 * Class ImageBuilder
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class ImageBuilder implements ImageBuilderInterface
{
    /**
     * @var ImageInterface
     */
    private $image;

    /**
     * {@inheritdoc}
     */
    public function create(): ImageBuilderInterface
    {
        $this->image = new ImageInteractor();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setImage(ImageInterface $image): ImageBuilderInterface
    {
        $this->image = $image;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withName(string $name): ImageBuilderInterface
    {
        $this->image->setName($name);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withExtension(string $extension): ImageBuilderInterface
    {
        $this->image->setExtension($extension);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withSize(string $size): ImageBuilderInterface
    {
        $this->image->setSize($size);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withLocalPath(string $localPath): ImageBuilderInterface
    {
        $this->image->setLocalPath($localPath);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withPublicPath(string $publicPath): ImageBuilderInterface
    {
        $this->image->setPublicPath($publicPath);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withUploadDate(\DateTime $uploadDate): ImageBuilderInterface
    {
        $this->image->setUploadDate($uploadDate);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withModificationDate(\DateTime $modificationDate): ImageBuilderInterface
    {
        $this->image->setModificationDate($modificationDate);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withUser(UserInterface $user): ImageBuilderInterface
    {
        $this->image->setUser($user);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withClient(ClientInterface $client): ImageBuilderInterface
    {
        $this->image->setClient($client);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withCompany(CompanyInterface $company): ImageBuilderInterface
    {
        $this->image->setCompany($company);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function build(): ImageInterface
    {
        return $this->image;
    }
}
