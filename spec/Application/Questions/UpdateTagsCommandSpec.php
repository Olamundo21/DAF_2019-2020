<?php

namespace spec\App\Application\Questions;

use App\Application\Questions\UpdateTagsCommand;
use App\Domain\Questions\Question\QuestionId;
use PhpSpec\ObjectBehavior;

class UpdateTagsCommandSpec extends ObjectBehavior
{

    private $tags;
    private $questionId;

    function let()
    {
        $this->tags = ['tag1', 'tag2'];
        $this->questionId = new QuestionId();
        $this->beConstructedWith($this->questionId, $this->tags);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateTagsCommand::class);
    }

    function it_has_a_question_id()
    {
        $this->questionId()->shouldBe($this->questionId);
    }

    function it_has_a_list_of_tags()
    {
        $this->tags()->shouldBe($this->tags);
    }
}
