<?php

namespace spec\App\Application\Questions;

use App\Application\Questions\EditQuestionCommand;
use App\Domain\Questions\Question\QuestionId;
use PhpSpec\ObjectBehavior;

class EditQuestionCommandSpec extends ObjectBehavior
{

    private $description;
    private $question;
    private $questionId;

    function let()
    {
        $this->description = 'description for it';
        $this->question = 'some new question?';
        $this->questionId = new QuestionId();
        $this->beConstructedWith($this->questionId, $this->question, $this->description);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(EditQuestionCommand::class);
    }

    function it_has_a_question_id()
    {
        $this->questionId()->shouldBe($this->questionId);
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
