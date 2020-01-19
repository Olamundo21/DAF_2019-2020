<?php

namespace spec\App\Application\Questions;

use App\Application\Questions\EditQuestionCommand;
use App\Application\Questions\EditQuestionHandler;
use App\Domain\Events\EventPublisher;
use App\Domain\Exception\InvalidQuestionOwner;
use App\Domain\Exception\InvalidQuestionState;
use App\Domain\Questions\Question;
use App\Domain\Questions\Question\QuestionId;
use App\Domain\Questions\QuestionsRepository;
use App\Domain\Questions\Specification\OpenQuestion;
use App\Domain\Questions\Specification\QuestionOwner;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EditQuestionHandlerSpec extends ObjectBehavior
{

    private $questionId;

    function let(
        QuestionsRepository $questions,
        OpenQuestion $openQuestion,
        QuestionOwner $questionOwner,
        Question $question,
        EventPublisher $eventPublisher
    ) {

        $this->questionId = new QuestionId();
        $questions->withId($this->questionId)->willReturn($question);
        $questions->update($question)->willReturn($question);

        $questionOwner->isSatisfiedBy($question)->willReturn(true);
        $openQuestion->isSatisfiedBy($question)->willReturn(true);

        $question->edit(
            Argument::type('string'),
            Argument::type('string')
        )
            ->willReturn($question);

        $this->beConstructedWith($questions, $openQuestion, $questionOwner, $eventPublisher);

    }

    function it_is_initializable()
    {
        $this->shouldHaveType(EditQuestionHandler::class);
    }

    function it_handles_the_edit_question_command(Question $question, QuestionsRepository $questions, EventPublisher $eventPublisher)
    {
        $newQuestion = 'New question?';
        $description = 'A given description';
        $command = new EditQuestionCommand(
            $this->questionId,
            $newQuestion,
            $description
        );
        $this->handle($command)->shouldBe($question);
        $question->edit($newQuestion, $description)
            ->shouldHaveBeenCalled();
        $questions->update($question)->shouldHaveBeenCalled();
        $eventPublisher->publishEventsFrom($question)->shouldHaveBeenCalled();
    }

    function it_throws_an_exception_when_user_is_not_the_owner(QuestionOwner $questionOwner, Question $question)
    {
        $newQuestion = 'New question?';
        $description = 'A given description';
        $command = new EditQuestionCommand(
            $this->questionId,
            $newQuestion,
            $description
        );
        $questionOwner->isSatisfiedBy($question)->willReturn(false);
        $this->shouldThrow(InvalidQuestionOwner::class)
            ->during('handle', [$command]);
    }

    function it_throws_an_exception_when_question_is_not_open(Question $question, OpenQuestion $openQuestion)
    {
        $newQuestion = 'New question?';
        $description = 'A given description';
        $command = new EditQuestionCommand(
            $this->questionId,
            $newQuestion,
            $description
        );
        $openQuestion->isSatisfiedBy($question)->willReturn(false);

        $this->shouldThrow(InvalidQuestionState::class)
            ->during('handle', [$command]);
    }
}
