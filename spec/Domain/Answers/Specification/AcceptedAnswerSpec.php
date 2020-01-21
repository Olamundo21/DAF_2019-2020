<?php

namespace spec\App\Domain\Answers\Specification;

use App\Domain\Answers\Answer;
use App\Domain\Answers\AnswerSpecification;
use App\Domain\Answers\Specification\AcceptedAnswer;
use PhpSpec\ObjectBehavior;

class AcceptedAnswerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(AcceptedAnswer::class);
    }

    function its_a_answer_specification()
    {
        $this->shouldBeAnInstanceOf(AnswerSpecification::class);
    }

    function it_validates_answer_when_flag_accepted_is_true(Answer $answer)
    {
        $answer->isAccepted()->shouldBeCalled()->willReturn(false);
        $this->isSatisfiedBy($answer)->shouldBe(false);

        $answer->isAccepted()->willReturn(true);
        $this->isSatisfiedBy($answer)->shouldBe(true);
    }
}
