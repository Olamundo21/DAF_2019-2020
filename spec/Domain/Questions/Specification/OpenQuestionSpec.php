<?php

namespace spec\App\Domain\Questions\Specification;

use App\Domain\Questions\Question;
use App\Domain\Questions\QuestionSpecification;
use App\Domain\Questions\Specification\OpenQuestion;
use PhpSpec\ObjectBehavior;

class OpenQuestionSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType(OpenQuestion::class);
    }

    function its_a_question_specification()
    {
        $this->shouldBeAnInstanceOf(QuestionSpecification::class);
    }

    function it_validates_question_when_flag_open_is_true(Question $question)
    {
        $question->isOpen()->shouldBeCalled()->willReturn(false);
        $this->isSatisfiedBy($question)->shouldBe(false);

        $question->isOpen()->willReturn(true);
        $this->isSatisfiedBy($question)->shouldBe(true);
    }
}
