<?php

namespace App\Domain\Answers\Events;

use App\Domain\Answers\Answer\AnswerId;
use App\Domain\Events\AbstractDomainEvent;
use App\Domain\Events\DomainEvent;

class AnswerWasEdited extends AbstractDomainEvent implements DomainEvent
{
    /**
     * @var AnswerId
     */
    private $answerId;
    /**
     * @var string
     */
    private $description;

    public function __construct(AnswerId $answerId, string $description)
    {
        parent::__construct();
        $this->answerId = $answerId;
        $this->description = $description;
    }

    public function answerId()
    {
        return $this->answerId;
    }

    public function description()
    {
        return $this->description;
    }
}
