<?php

/**
 * This file is part of S4Skeleton project
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Application\UserManagement\OAuth2;

use App\Domain\UserManagement\OAuth2\Client;
use App\Domain\UserManagement\OAuth2\ClientsRepository;

/**
 * CreateClientHandler
 *
 * @package App\Application\UserManagement\OAuth2
 */
final class CreateClientHandler
{
    /**
     * @var ClientsRepository
     */
    private $clientsRepository;

    /**
     * Creates a CreateClientHandler
     *
     * @param ClientsRepository $clientsRepository
     */
    public function __construct(ClientsRepository $clientsRepository)
    {
        $this->clientsRepository = $clientsRepository;
    }

    /**
     * @param CreateClientCommand $command
     * @return Client
     * @throws \Exception
     */
    public function handle(CreateClientCommand $command): Client
    {
        $client = new Client($command->identifier(), $command->name(), $command->secret());
        return $this->clientsRepository->add($client);
    }
}
