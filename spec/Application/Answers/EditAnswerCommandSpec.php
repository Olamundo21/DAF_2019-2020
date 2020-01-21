<?php

namespace spec\App\Application\Answers;

use App\Application\Answers\EditAnswerCommand;
use App\Domain\Answers\Answer\AnswerId;
use App\Domain\Questions\Question\QuestionId;
use App\Domain\UserManagement\User\UserId;
use PhpSpec\ObjectBehavior;
use spec\App\Domain\Answers\Answer\AnswerIdSpec;

class EditAnswerCommandSpec extends ObjectBehavior
{
    private $answerId;
    private $description;

    function let()
    {
        $this->answerId = new AnswerId();
        $this->description = 'Answer to the question';
        $this->beConstructedWith($this->answerId, $this->description);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(EditAnswerCommand::class);
    }

    function it_must_have_a_answer_id()
    {
        $this->answerId()->shouldBe($this->answerId);
    }

    function it_has_a_description()
    {
        $this->description()->shouldBe($this->description);
    }
}
