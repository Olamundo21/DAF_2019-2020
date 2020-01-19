<?php

namespace App\Domain\Questions\EventListeners;

use App\Domain\Events\DomainEvent;
use App\Domain\Events\EventListener;
use App\Domain\Events\EventPublisher;
use App\Domain\Questions\Events\TagsWereRemoved;
use App\Domain\Questions\Events\TagsWereUpdated;
use App\Domain\Questions\Tag;
use Exception;

abstract class DeleteOrphanTags implements EventListener
{
    /**
     * @var EventPublisher
     */
    protected $eventPublisher;

    /**
     * Creates a DeleteOrphanTags
     *
     * @param EventPublisher $eventPublisher
     */
    public function __construct(EventPublisher $eventPublisher)
    {
        $this->eventPublisher = $eventPublisher;
    }

    /**
     * Delete Orphan Tags
     *
     * @return Tag[]|array
     */
    abstract protected function deleteOrphanTags(): array;

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function handle(DomainEvent $event): void
    {
        if (!$event instanceof TagsWereUpdated) {
            return;
        }

        $tags = $this->deleteOrphanTags();
        if (empty($tags)) {
            return;
        }

        $this->eventPublisher->publish(new TagsWereRemoved($tags));
    }
}
