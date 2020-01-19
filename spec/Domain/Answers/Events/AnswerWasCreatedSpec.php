<?php

namespace spec\App\Domain\Answers\Events;

use App\Domain\Answers\Answer;
use App\Domain\Answers\Events\AnswerWasCreated;
use App\Domain\Events\AbstractDomainEvent;
use App\Domain\Events\DomainEvent;
use DateTimeImmutable;
use PhpSpec\ObjectBehavior;

class AnswerWasCreatedSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AnswerWasCreated::class);
    }
    public function let(Answer $answer)
    {
        $this->beConstructedWith($answer);
    }

    function it_has_a_answer(Answer $answer)
    {
        $this->answer()->shouldBe($answer);
    }

    function its_a_domain_event()
    {
        $this->shouldBeAnInstanceOf(DomainEvent::class);
        $this->shouldHaveType(AbstractDomainEvent::class);
        $this->occurredOn()->shouldBeAnInstanceOf(DateTimeImmutable::class);
    }
}
