<?php

/**
 * Created by PhpStorm.
 * User: fsilva
 * Date: 03-12-2018
 * Time: 18:31
 */

namespace App\Infrastructure\CommandBus;

use League\Tactician\Exception\MissingHandlerException;
use League\Tactician\Handler\Locator\HandlerLocator;
use Symfony\Component\DependencyInjection\Container;

/**
 * HandlerLocator
 *
 * @package App\Infrastructure\CommandBus
 */
final class ClassNameHandlerLocator implements HandlerLocator
{
    /**
     * @var Container
     */
    private $container;

    /**
     * ClassNameHandlerLocator constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Retrieves the handler for a specified command
     *
     * @param string $commandName
     *
     * @return object
     *
     * @throws MissingHandlerException
     * @throws \Exception
     */
    public function getHandlerForCommand($commandName)
    {
        $parts = explode('\\', $commandName);
        $last = array_pop($parts);
        $last = str_replace('Command', 'Handler', $last);
        array_push($parts, $last);
        $handler = implode('\\', $parts);

        return $this->container->get($handler);
    }
}