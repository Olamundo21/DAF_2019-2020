<?php

namespace spec\App\Application\Answers;

use App\Application\Answers\AddAnswerCommand;
use App\Domain\Questions\Question\QuestionId;
use App\Domain\UserManagement\User\UserId;
use PhpSpec\ObjectBehavior;

class AddAnswerCommandSpec extends ObjectBehavior
{
    private $questionId;
    private $userId;
    private $description;

    function let()
    {
        $this->questionId = new QuestionId();
        $this->userId = new UserId();
        $this->description = 'Answer to the question';
        $this->beConstructedWith($this->userId, $this->questionId, $this->description);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AddAnswerCommand::class);
    }

    function it_must_have_a_question_id()
    {
        $this->questionId()->shouldBe($this->questionId);
    }

    function it_has_a_user_id()
    {
        $this->userId()->shouldBe($this->userId);
    }

    function it_has_a_description()
    {
        $this->description()->shouldBe($this->description);
    }
}
