<?php

namespace App\Domain\Questions\Events;

use App\Domain\Events\AbstractDomainEvent;
use App\Domain\Events\DomainEvent;
use App\Domain\Questions\Tag;
use Exception;

class TagsWereRemoved extends AbstractDomainEvent implements DomainEvent
{
    /**
     * @var array
     */
    private $tags;

    /**
     * Creates a TagsWereRemoved
     *
     * @param array $tags
     * @throws Exception
     */
    public function __construct(array $tags)
    {
        parent::__construct();
        $this->tags = $tags;
    }

    /**
     * Removed tags
     *
     * @return Tag[]|array
     */
    public function tags(): array
    {
        return $this->tags;
    }
}
