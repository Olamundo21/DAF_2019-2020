<?php

namespace App\Domain\Questions\Events;

use App\Domain\Events\AbstractDomainEvent;
use App\Domain\Events\DomainEvent;
use App\Domain\Questions\Question;
use Exception;

/**
 * QuestionWasCreated
 *
 * @package App\Domain\Questions\Events
 */
class QuestionWasCreated extends AbstractDomainEvent implements DomainEvent
{
    /**
     * @var Question
     */
    private $question;

    /**
     * QuestionWasCreated constructor.
     * @param Question $question
     * @throws Exception
     */
    public function __construct(Question $question)
    {
        parent::__construct();
        $this->question = $question;
    }

    /**
     * Creates question
     *
     * @return Question
     */
    public function question(): Question
    {
        return $this->question;
    }
}
