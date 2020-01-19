<?php


namespace App\Domain\Events;

/**
 * Interface Event Listener
 *
 * @package App\Domain\Events
 */
interface EventListener
{
    /**
     * Handles the provided event
     *
     * @param DomainEvent $event
     */
    public function handle(DomainEvent $event): void;
}