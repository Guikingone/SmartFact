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

namespace App\Builders\Interfaces;

use App\Models\Interfaces\UserInterface;
use App\Models\Interfaces\ImageInterface;
use App\Models\Interfaces\ClientInterface;

/**
 * Interface ImageBuilderInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface ImageBuilderInterface
{
    /**
     * @return ImageBuilderInterface
     */
    public function create(): ImageBuilderInterface;

    /**
     * @param ImageInterface $image
     *
     * @return ImageBuilderInterface
     */
    public function setImage(ImageInterface $image): ImageBuilderInterface;

    /**
     * @param string $name
     *
     * @return ImageBuilderInterface
     */
    public function withName(string $name): ImageBuilderInterface;

    /**
     * @param string $extension
     *
     * @return ImageBuilderInterface
     */
    public function withExtension(string $extension): ImageBuilderInterface;

    /**
     * @param string $size
     *
     * @return ImageBuilderInterface
     */
    public function withSize(string $size): ImageBuilderInterface;

    /**
     * @param string $localPath
     *
     * @return ImageBuilderInterface
     */
    public function withLocalPath(string $localPath): ImageBuilderInterface;

    /**
     * @param string $publicPath
     *
     * @return ImageBuilderInterface
     */
    public function withPublicPath(string $publicPath): ImageBuilderInterface;

    /**
     * @param \DateTime $uploadDate
     *
     * @return ImageBuilderInterface
     */
    public function withUploadDate(\DateTime $uploadDate): ImageBuilderInterface;

    /**
     * @param \DateTime $modificationDate
     *
     * @return ImageBuilderInterface
     */
    public function withModificationDate(\DateTime $modificationDate): ImageBuilderInterface;

    /**
     * @param UserInterface $user
     *
     * @return ImageBuilderInterface
     */
    public function withUser(UserInterface $user): ImageBuilderInterface;

    /**
     * @param ClientInterface $client
     *
     * @return ImageBuilderInterface
     */
    public function withClient(ClientInterface $client): ImageBuilderInterface;

    /**
     * @return ImageInterface
     */
    public function build(): ImageInterface;
}
