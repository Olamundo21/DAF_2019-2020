<?php


namespace App\Domain\Events;

/**
 * Interface EventGenerator
 *
 * @package App\Domain\Events
 */
interface EventGenerator
{

    /**
     * Records an event
     *
     * @param DomainEvent $event
     */
    public function recordThat(DomainEvent $event): void;

    /**
     * Releases all recorded events
     *
     * The events list of this generator SHOULD be cleared every time
     * this method is called.
     *
     * @return array|DomainEvent[]
     */
    public function releaseEvents(): array;
}