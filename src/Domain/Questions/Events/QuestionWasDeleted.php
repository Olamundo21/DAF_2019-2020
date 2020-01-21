<?php

namespace App\Domain\Questions\Events;

use App\Domain\Events\AbstractDomainEvent;
use App\Domain\Events\DomainEvent;
use App\Domain\Questions\Question\QuestionId;

class QuestionWasDeleted extends AbstractDomainEvent implements DomainEvent
{
    /**
     * @var QuestionId
     */
    private $questionId;

    /**
     * QuestionWasDeleted constructor.
     * @param QuestionId $questionId
     */
    public function __construct(QuestionId $questionId)
    {
        parent::__construct();
        $this->questionId = $questionId;
    }

    public function questionId()
    {
        return $this->questionId;
    }
}
