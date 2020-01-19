<?php

/**
 * This file is part of S4Skeleton project
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Application\UserManagement\OAuth2;

/**
 * CreateClientCommand
 *
 * @package App\Application\UserManagement\OAuth2
 */
final class CreateClientCommand
{
    /**
     * @var string
     */
    private $identifier;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $secret;

    /**
     * Creates a CreateClientCommand
     *
     * @param string $identifier
     * @param string $name
     * @param string|null $secret
     */
    public function __construct(string $identifier, string $name, string $secret = null)
    {
        $this->identifier = $identifier;
        $this->name = $name;
        $this->secret = $secret;
    }

    public function identifier(): string
    {
        return $this->identifier;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function secret(): ?string
    {
        return $this->secret;
    }
}
