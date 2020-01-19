<?php

namespace App\Domain\Events;

/**
 * Trait Event Generator Methods
 *
 * Methods that implement the EventGenerator interface.
 *
 * @package App\Domain\Events
 */
trait EventGeneratorMethods
{

    /**
     * @var DomainEvent[]
     */
    protected $events;

    /**
     * Records an event
     *
     * @param DomainEvent $event
     */
    public function recordThat(DomainEvent $event): void
    {
        $this->events[] = $event;
    }

    /**
     * Releases all recorded events
     *
     * The events list of this generator SHOULD be cleared every time
     * this method is called.
     *
     * @return array|DomainEvent[]
     */
    public function releaseEvents(): array
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    }
}
