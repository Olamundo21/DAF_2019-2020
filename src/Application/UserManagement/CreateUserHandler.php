<?php

/**
 * This file is part of S4Skeleton project
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Application\UserManagement;

use App\Domain\UserManagement\User;
use App\Domain\UserManagement\UsersRepository;

/**
 * CreateUserHandler
 *
 * @package App\Application\UserManagement
 */
final class CreateUserHandler
{
    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * Creates a CreateUserHandler
     *
     * @param UsersRepository $usersRepository
     */
    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * @param CreateUserCommand $command
     * @return User
     * @throws \Exception
     */
    public function handle(CreateUserCommand $command): User
    {
        $user = new User($command->name(), $command->email(), $command->password());
        return $this->usersRepository->add($user);
    }
}
