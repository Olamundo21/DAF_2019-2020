<?php

/**
 * This file is part of S4Skeleton project
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UserInterface\UserManagement\OAuth2;

use App\Domain\UserManagement\User;

/**
 * AuthenticatedControllerInterface
 *
 * @package App\Controller\UserManagement\OAuth2
 */
interface AuthenticatedControllerInterface
{

    /**
     * Current logged in user
     *
     * @return User
     */
    public function currentUser(): User;

    /**
     * Set current working user
     *
     * @param User $user
     *
     * @return AuthenticatedControllerInterface|$this
     */
    public function withCurrentUser(User $user): AuthenticatedControllerInterface;
}
