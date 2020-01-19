<?php

/**
 * This file is part of S4Skeleton project
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Application\UserManagement;

use App\Domain\UserManagement\User\Email;
use App\Domain\UserManagement\User\Password;

/**
 * CreateUserCommand
 *
 * @package App\Application\UserManagement
 */
final class CreateUserCommand
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Email
     */
    private $email;

    /**
     * @var Password
     */
    private $password;

    /**
     * Creates a CreateUserCommand
     *
     * @param string $name
     * @param Email $email
     * @param Password|null $password
     */
    public function __construct(string $name, Email $email, Password $password = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password ?: new Password();
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function password(): Password
    {
        return $this->password;
    }
}
