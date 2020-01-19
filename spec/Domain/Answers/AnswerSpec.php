<?php

namespace spec\App\Domain\Answers;

use App\Domain\Answers\Answer;
use App\Domain\Answers\Answer\AnswerId;
use App\Domain\Answers\Events\AnswerWasCreated;
use App\Domain\Answers\Events\AnswerWasEdited;
use App\Domain\Events\EventGenerator;
use App\Domain\UserManagement\User\UserId;
use DateTimeImmutable;
use PhpSpec\ObjectBehavior;

class AnswerSpec extends ObjectBehavior
{
    private $userId;
    private $description;

    function it_is_initializable()
    {
        $this->shouldHaveType(Answer::class);
    }

    function let()
    {
        $this->userId = new UserId();
        $this->description = 'Really nice answer';
        $this->beConstructedWith($this->userId, $this->description);
    }

    function its_an_event_generator()
    {
        $this->shouldBeAnInstanceOf(EventGenerator::class);
        $this->releaseEvents()[0]->shouldBeAnInstanceOf(AnswerWasCreated::class);
    }

    function it_has_a_answer_id()
    {
        $this->answerId()->shouldBeAnInstanceOf(Answer\AnswerId::class);
    }

    function it_has_a_description()
    {
        $this->description()->shouldBe($this->description);
    }

    function it_has_an_applied_date_time()
    {
        $this->appliedOn()->shouldBeAnInstanceOf(DateTimeImmutable::class);
    }

    function it_has_an_accepted_state()
    {
        $this->isAccepted()->shouldBe(true);
    }

    function it_can_be_edited()
    {
        $this->releaseEvents();
        $description = 'new description';
        $this->lastEditedOn()->shouldBe(null);
        $this->edit($description)->shouldBe($this->getWrappedObject());

        $this->description()->shouldBe($description);
        $this->lastEditedOn()->shouldBeAnInstanceOf(DateTimeImmutable::class);
        $this->releaseEvents()[0]->shouldBeAnInstanceOf(AnswerWasEdited::class);
    }
}
