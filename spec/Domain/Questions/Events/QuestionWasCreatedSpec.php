<?php

namespace spec\App\Domain\Questions\Events;

use App\Domain\Events\AbstractDomainEvent;
use App\Domain\Events\DomainEvent;
use App\Domain\Questions\Events\QuestionWasCreated;
use App\Domain\Questions\Question;
use DateTimeImmutable;
use PhpSpec\ObjectBehavior;

class QuestionWasCreatedSpec extends ObjectBehavior
{

    public function let(Question $question)
    {
        $this->beConstructedWith($question);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(QuestionWasCreated::class);
    }

    function it_has_a_question(Question $question)
    {
        $this->question()->shouldBe($question);
    }

    function its_a_domain_event()
    {
        $this->shouldBeAnInstanceOf(DomainEvent::class);
        $this->shouldHaveType(AbstractDomainEvent::class);
        $this->occurredOn()->shouldBeAnInstanceOf(DateTimeImmutable::class);
    }
}
