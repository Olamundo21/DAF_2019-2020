<?php


namespace App\Domain\Events;

/**
 * Interface EventPublisher
 *
 * @package App\Domain\Events
 */
interface EventPublisher
{

    /**
     * Publishes an event
     *
     * @param DomainEvent $event
     */
    public function publish(DomainEvent $event): void;

    /**
     * Published recorder events form an event generator
     *
     * @param EventGenerator $generator
     */
    public function publishEventsFrom(EventGenerator $generator): void;

    /**
     * Adds an event listener to the listeners stack of provider event name
     *
     * @param string        $event
     * @param EventListener $eventListener
     */
    public function addListener(string $event, EventListener $eventListener): void;
}