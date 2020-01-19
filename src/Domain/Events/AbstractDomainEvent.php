<?php

namespace App\Domain\Events;

use DateTimeImmutable;
use League\Event\AbstractEvent;

/**
 * Abstract Domain Event
 *
 * @package App\Domain\Events
 */
abstract class AbstractDomainEvent extends AbstractEvent implements DomainEvent
{

    /**
     * @var DateTimeImmutable
     */
    private $occurredOn;

    /**
     * Creates a Domain event
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->occurredOn = new DateTimeImmutable();
    }

    /**
     * Date and time events occurs
     *
     * @return DateTimeImmutable
     */
    public function occurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
