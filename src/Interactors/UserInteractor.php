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

namespace App\Interactors;

use App\Models\User;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Class UserInteractor
 *
 * @author Guillaume Loulier <contact@guillaumeloulier.fr>
 */
class UserInteractor extends User implements AdvancedUserInterface
{
    /**
     * UserInteractor constructor.
     */
    public function __construct()
    {
        $this->clients = new ArrayCollection();
        $this->bills = new ArrayCollection();
        $this->notifications = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function isAccountNonLocked()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function isEnabled()
    {
        return $this->active;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function eraseCredentials()
    {
    }
}
