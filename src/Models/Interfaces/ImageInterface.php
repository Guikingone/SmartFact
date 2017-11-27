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

namespace App\Models\Interfaces;

/**
 * Interface ImageInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface ImageInterface
{
    /**
     * @return int|null
     */
    public function getId():? int;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name);

    /**
     * @return null|string
     */
    public function getExtension():? string;

    /**
     * @param string $extension
     */
    public function setExtension(string $extension);

    /**
     * @return null|string
     */
    public function getSize():? string;

    /**
     * @param string $size
     */
    public function setSize(string $size);

    /**
     * @return null|string
     */
    public function getLocalPath():? string;

    /**
     * @param string $localPath
     */
    public function setLocalPath(string $localPath);

    /**
     * @return string
     */
    public function getPublicPath(): string;

    /**
     * @param string $publicPath
     */
    public function setPublicPath(string $publicPath);

    /**
     * @return string
     */
    public function getUploadDate(): string;

    /**
     * @param \DateTime $uploadDate
     */
    public function setUploadDate(\DateTime $uploadDate);

    /**
     * @return null|string
     */
    public function getModificationDate():? string;

    /**
     * @param \DateTime $modificationDate
     */
    public function setModificationDate(\DateTime $modificationDate);

    /**
     * @return UserInterface|null
     */
    public function getUser():? UserInterface;

    /**
     * @param UserInterface $user
     */
    public function setUser(UserInterface $user);

    /**
     * @return ClientInterface|null
     */
    public function getClient():? ClientInterface;

    /**
     * @param ClientInterface $client
     */
    public function setClient(ClientInterface $client);
}
