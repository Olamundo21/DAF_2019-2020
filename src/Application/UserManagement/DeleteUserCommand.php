<?php

/**
 * This file is part of S4Skeleton project
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Application\UserManagement;

use App\Domain\UserManagement\User\Email;

/**
 * DeleteUserCommand
 *
 * @package App\Application\UserManagement
 */
final class DeleteUserCommand
{
    /**
     * @var Email
     */
    private $email;

    /**
     * Creates a DeleteUserCommand
     *
     * @param Email $email
     */
    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    public function email(): Email
    {
        return $this->email;
    }
}
