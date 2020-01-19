<?php

/**
 * This file is part of S4Skeleton project
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Application\UserManagement;

use App\Domain\UserManagement\UsersRepository;

/**
 * DeleteUserHandler
 *
 * @package App\Application\UserManagement
 */
final class DeleteUserHandler
{
    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * Creates a DeleteUserHandler
     *
     * @param UsersRepository $usersRepository
     */
    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function handle(DeleteUserCommand $command): void
    {
        $user = $this->usersRepository->withEmail($command->email());
        $this->usersRepository->remove($user);
    }
}
