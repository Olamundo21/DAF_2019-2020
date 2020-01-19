<?php

namespace App\Domain\Questions\Events;

use App\Domain\Events\AbstractDomainEvent;
use App\Domain\Events\DomainEvent;
use App\Domain\Questions\Question\QuestionId;
use Doctrine\Common\Collections\Collection;

class TagsWereUpdated extends AbstractDomainEvent implements DomainEvent
{
    /**
     * @var QuestionId
     */
    private $questionId;

    /**
     * @var Collection
     */
    private $tags;

    /**
     * Creates a TagsWereUpdated
     *
     * @param QuestionId $questionId
     * @param Collection $tags
     */
    public function __construct(QuestionId $questionId, Collection $tags)
    {
        parent::__construct();
        $this->questionId = $questionId;
        $this->tags = $tags;
    }

    /**
     * questionId
     *
     * @return QuestionId
     */
    public function questionId(): QuestionId
    {
        return $this->questionId;
    }

    /**
     * tags
     *
     * @return Collection
     */
    public function tags(): Collection
    {
        return $this->tags;
    }
}
