<?php

namespace spec\App\Domain\Questions\Events;

use App\Domain\Events\AbstractDomainEvent;
use App\Domain\Events\DomainEvent;
use App\Domain\Questions\Events\QuestionWasDeleted;
use App\Domain\Questions\Question\QuestionId;
use DateTimeImmutable;
use PhpSpec\ObjectBehavior;

class QuestionWasDeletedSpec extends ObjectBehavior
{
    private $questionId;

    function let()
    {
        $this->questionId = new QuestionId();
        $this->beConstructedWith($this->questionId);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType(QuestionWasDeleted::class);
    }

    function it_has_a_question_id()
    {
        $this->questionId()->shouldBe($this->questionId);
    }

    function its_a_domain_event()
    {
        $this->shouldBeAnInstanceOf(DomainEvent::class);
        $this->shouldHaveType(AbstractDomainEvent::class);
        $this->occurredOn()->shouldBeAnInstanceOf(DateTimeImmutable::class);
    }
}
