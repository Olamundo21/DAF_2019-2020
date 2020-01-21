<?php

namespace App\Domain\Answers\Events;

use App\Domain\Answers\Answer\AnswerId;
use App\Domain\Events\AbstractDomainEvent;
use App\Domain\Events\DomainEvent;

class AnswerWasDeleted extends AbstractDomainEvent implements DomainEvent
{
    /**
     * @var AnswerId
     */
    private $answerId;

    /**
     * AnswerWasDeleted constructor.
     * @param AnswerId $answerId
     * @throws \Exception
     */
    public function __construct(AnswerId $answerId)
    {
        parent::__construct();
        $this->answerId = $answerId;
    }

    public function answerId()
    {
        return $this->answerId;
    }
}
