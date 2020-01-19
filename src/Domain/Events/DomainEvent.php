<?php


namespace App\Domain\Events;

use DateTimeImmutable;
use League\Event\EventInterface;

/**
 * Interface DomainEvent
 * @package App\Domain\Events
 */
interface DomainEvent extends EventInterface
{
    /**
     * Date and time events occurs
     *
     * @return DateTimeImmutable
     */
    public function occurredOn(): DateTimeImmutable;
}