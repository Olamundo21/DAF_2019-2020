<?php

namespace spec\App\Application\Questions;

use App\Application\Questions\AddQuestionCommand;
use App\Domain\UserManagement\User\UserId;
use PhpSpec\ObjectBehavior;

class AddQuestionCommandSpec extends ObjectBehavior
{

    private $userId;
    private $question;
    private $description;

    function let()
    {
        $this->userId = new UserId();
        $this->question = 'What?';
        $this->description = 'Else...';
        $this->beConstructedWith($this->userId, $this->question, $this->description);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AddQuestionCommand::class);
    }

    function it_has_a_user_id()
    {
        $this->userId()->shouldBe($this->userId);
    }

    function it_has_a_question()
    {
        $this->question()->shouldBe($this->question);
    }

    function it_has_a_description()
    {
        $this->description()->shouldBe($this->description);
    }
}
