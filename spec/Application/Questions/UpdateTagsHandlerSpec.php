<?php

namespace spec\App\Application\Questions;

use App\Application\Questions\UpdateTagsCommand;
use App\Application\Questions\UpdateTagsHandler;
use App\Domain\Events\EventPublisher;
use App\Domain\Exception\InvalidQuestionOwner;
use App\Domain\Exception\InvalidQuestionState;
use App\Domain\Questions\Question;
use App\Domain\Questions\QuestionsRepository;
use App\Domain\Questions\Specification\OpenQuestion;
use App\Domain\Questions\Specification\QuestionOwner;
use App\Domain\Questions\Tag;
use App\Domain\Questions\Tag\TagsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use PhpSpec\ObjectBehavior;

class UpdateTagsHandlerSpec extends ObjectBehavior
{

    private $questionId;
    private $tags;
    private $tagList;

    function let(
        QuestionsRepository $questions,
        TagsRepository $tags,
        EventPublisher $eventPublisher,
        Question $question,
        QuestionOwner $questionOwner,
        OpenQuestion $openQuestion
    ) {

        $this->questionId = new Question\QuestionId();
        $this->tags = new ArrayCollection([new Tag('1')]);
        $this->tagList = ['1'];

        $tags->getList($this->tagList)->willReturn($this->tags);
        $questions->withId($this->questionId)->willReturn($question);
        $question->updateTags($this->tags)->willReturn($question);
        $questions->update($question)->willReturn($question);

        $questionOwner->isSatisfiedBy($question)->willReturn(true);
        $openQuestion->isSatisfiedBy($question)->willReturn(true);

        $this->beConstructedWith($questions, $tags, $eventPublisher, $questionOwner, $openQuestion);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateTagsHandler::class);
    }

    function it_handles_update_tags_command(Question $question, QuestionsRepository $questions, EventPublisher $eventPublisher)
    {
        $command = new UpdateTagsCommand($this->questionId, $this->tagList);
        $this->handle($command)->shouldBe($question);
        $question->updateTags($this->tags)->shouldHaveBeenCalled();
        $questions->update($question)->shouldHaveBeenCalled();
        $eventPublisher->publishEventsFrom($question)->shouldHaveBeenCalled();
    }

    function it_throws_exception_when_user_is_not_the_owner(QuestionOwner $questionOwner, Question $question)
    {
        $questionOwner->isSatisfiedBy($question)->willReturn(false);
        $command = new UpdateTagsCommand($this->questionId, $this->tagList);

        $this->shouldThrow(InvalidQuestionOwner::class)
            ->during('handle', [$command]);
    }

    function it_throws_exception_when_question_is_closed(Question $question, OpenQuestion $openQuestion)
    {
        $openQuestion->isSatisfiedBy($question)->willReturn(false);
        $command = new UpdateTagsCommand($this->questionId, $this->tagList);
        $this->shouldThrow(InvalidQuestionState::class)
            ->during('handle', [$command]);
    }
}
