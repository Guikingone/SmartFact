<?php

/*
 * This file is part of the SmartFact project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Interfaces;

/**
 * Interface SmartFactNotificationsInterface
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
interface SmartFactNotificationsInterface
{
    public function getId();

    public function getName();

    public function getCategory();

    public function getCreatedAt();

    public function getLink();

    public function getContent();

    public function hasRepetition();

    public function hasBeenChecked();

    public function getUser();
}
