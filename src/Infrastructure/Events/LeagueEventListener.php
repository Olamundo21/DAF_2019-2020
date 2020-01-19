<?php

namespace App\Infrastructure\Events;

use App\Domain\Events\DomainEvent;
use App\Domain\Events\EventGenerator;
use App\Domain\Events\EventListener;
use App\Domain\Events\EventPublisher;
use League\Event\EmitterInterface;
use League\Event\EventInterface;

/**
 * Class LeagueEventListener
 * @package App\Infrastructure\Events
 */
class LeagueEventListener implements EventPublisher
{
    /**
     * @var EmitterInterface
     */
    private $emitter;

    /**
     * LeagueEventListener constructor.
     * @param EmitterInterface $emitter
     */
    public function __construct(EmitterInterface $emitter)
    {
        $this->emitter = $emitter;
    }

    /**
     * @inheritDoc
     */
    public function publish(DomainEvent $event): void
    {
        $this->emitter->emit($event);
    }

    /**
     * @inheritDoc
     */
    public function publishEventsFrom(EventGenerator $generator): void
    {
        $this->emitter->emitBatch($generator->releaseEvents());
    }

    /**
     * @inheritDoc
     */
    public function addListener(string $event, EventListener $eventListener): void
    {
        $listener = function ($event) use ($eventListener) {
            $eventListener->handle($event);
        };
        $this->emitter->addListener($event, $listener);
    }
}
