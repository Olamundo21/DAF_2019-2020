<?php

namespace spec\App\Domain\Questions\Events;

use App\Domain\Events\AbstractDomainEvent;
use App\Domain\Events\DomainEvent;
use App\Domain\Questions\Events\QuestionWasEdited;
use App\Domain\Questions\Question\QuestionId;
use DateTimeImmutable;
use PhpSpec\ObjectBehavior;

class QuestionWasEditedSpec extends ObjectBehavior
{

    private $questionId;
    private $question;
    private $description;

    function let()
    {
        $this->questionId = new QuestionId();
        $this->question = 'question';
        $this->description = 'description';
        $this->beConstructedWith($this->questionId, $this->question, $this->description);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(QuestionWasEdited::class);
    }

    function its_a_domain_event()
    {
        $this->shouldBeAnInstanceOf(DomainEvent::class);
        $this->shouldHaveType(AbstractDomainEvent::class);
        $this->occurredOn()->shouldBeAnInstanceOf(DateTimeImmutable::class);
    }

    function it_has_a_question_id()
    {
        $this->questionId()->shouldBe($this->questionId);
    }

    function it_has_a_question_string()
    {
        $this->question()->shouldBe($this->question);
    }

    function it_has_a_description()
    {
        $this->description()->shouldBe($this->description);
    }
}
