<?php

namespace spec\App\Domain\Answers\Events;

use App\Domain\Answers\Answer\AnswerId;
use App\Domain\Answers\Events\AnswerWasEdited;
use App\Domain\Events\AbstractDomainEvent;
use App\Domain\Events\DomainEvent;
use DateTimeImmutable;
use PhpSpec\ObjectBehavior;

class AnswerWasEditedSpec extends ObjectBehavior
{
    private $answerId;
    private $description;

    function let()
    {
        $this->answerId = new AnswerId();
        $this->description = 'description';
        $this->beConstructedWith($this->answerId, $this->description);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AnswerWasEdited::class);
    }

    function its_a_domain_event()
    {
        $this->shouldBeAnInstanceOf(DomainEvent::class);
        $this->shouldHaveType(AbstractDomainEvent::class);
        $this->occurredOn()->shouldBeAnInstanceOf(DateTimeImmutable::class);
    }

    function it_has_a_answer_id()
    {
        $this->answerId()->shouldBe($this->answerId);
    }


    function it_has_a_description()
    {
        $this->description()->shouldBe($this->description);
    }
}

