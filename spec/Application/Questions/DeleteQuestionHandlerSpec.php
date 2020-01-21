<?php

namespace spec\App\Application\Questions;

use App\Application\Questions\DeleteQuestionCommand;
use App\Application\Questions\DeleteQuestionHandler;
use App\Domain\Events\EventPublisher;
use App\Domain\Exception\InvalidQuestionOwner;
use App\Domain\Exception\InvalidQuestionState;
use App\Domain\Questions\Question;
use App\Domain\Questions\Question\QuestionId;
use App\Domain\Questions\QuestionsRepository;
use App\Domain\Questions\Specification\OpenQuestion;
use App\Domain\Questions\Specification\QuestionOwner;
use PhpSpec\ObjectBehavior;

class DeleteQuestionHandlerSpec extends ObjectBehavior
{
    private $questionId;

    function it_is_initializable()
    {
        $this->shouldHaveType(DeleteQuestionHandler::class);
    }

    function let(
        QuestionsRepository $questions,
        OpenQuestion $openQuestion,
        QuestionOwner $questionOwner,
        Question $question,
        EventPublisher $eventPublisher
    ) {
        $this->questionId = new QuestionId();
        $questions->withId($this->questionId)->willReturn($question);

        $questionOwner->isSatisfiedBy($question)->willReturn(true);
        $openQuestion->isSatisfiedBy($question)->willReturn(true);

        $this->beConstructedWith($questions, $openQuestion, $questionOwner, $eventPublisher);
    }

    function it_handles_the_delete_question_command(Question $question, QuestionsRepository $questions, EventPublisher $eventPublisher)
    {
        $command = new DeleteQuestionCommand($this->questionId);

        $this->handle($command)->shouldBe($question);
        $questions->remove($question)->shouldHaveBeenCalled();
        $eventPublisher->publishEventsFrom($question)->shouldHaveBeenCalled();
    }

    function it_throws_an_exception_when_user_is_not_the_owner(QuestionOwner $questionOwner, Question $question)
    {
        $command = new DeleteQuestionCommand($this->questionId);

        $questionOwner->isSatisfiedBy($question)->willReturn(false);
        $this->shouldThrow(InvalidQuestionOwner::class)
            ->during('handle', [$command]);
    }

    function it_throws_an_exception_when_question_is_not_open(Question $question, OpenQuestion $openQuestion)
    {
        $command = new DeleteQuestionCommand($this->questionId);

        $openQuestion->isSatisfiedBy($question)->willReturn(false);
        $this->shouldThrow(InvalidQuestionState::class)
            ->during('handle', [$command]);
    }
}
