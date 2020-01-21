<?php

namespace spec\App\Application\Answers;

use App\Application\Answers\DeleteAnswerCommand;
use App\Application\Answers\DeleteAnswerHandler;
use App\Domain\Answers\Answer;
use App\Domain\Answers\Answer\AnswerId;
use App\Domain\Answers\AnswersRepository;
use App\Domain\Answers\Specification\AcceptedAnswer;
use App\Domain\Answers\Specification\AnswerOwner;
use App\Domain\Events\EventPublisher;
use App\Domain\Exception\InvalidAnswerOwner;
use App\Domain\Exception\InvalidAnswerState;
use App\Domain\Questions\Question;
use App\Domain\Questions\Question\QuestionId;
use App\Domain\Questions\QuestionsRepository;
use PhpSpec\ObjectBehavior;

class DeleteAnswerHandlerSpec extends ObjectBehavior
{
    private $answerId;
    private $questionId;

    function it_is_initializable()
    {
        $this->shouldHaveType(DeleteAnswerHandler::class);
    }

    function let(
        AnswersRepository $answers,
        AcceptedAnswer $acceptedAnswer,
        AnswerOwner $answerOwner,
        QuestionsRepository $questions,
        Answer $answer,
        Question $question,
        EventPublisher $eventPublisher
    ) {
        $this->questionId = new QuestionId();
        $questions->withId($this->questionId)->willReturn($question);

        $this->answerId = new AnswerId();
        $answers->withId($this->answerId)->willReturn($answer);

        $answerOwner->isSatisfiedBy($answer)->willReturn(true);
        $acceptedAnswer->isSatisfiedBy($answer)->willReturn(true);

        $this->beConstructedWith($answers, $acceptedAnswer, $answerOwner, $eventPublisher);
    }

    function it_handles_the_delete_answer_command(Answer $answer, AnswersRepository $answers, EventPublisher $eventPublisher)
    {
        $command = new DeleteAnswerCommand($this->answerId);

        $this->handle($command)->shouldBe($answer);
        $answers->remove($answer)->shouldHaveBeenCalled();
        $eventPublisher->publishEventsFrom($answer)->shouldHaveBeenCalled();
    }

    function it_throws_an_exception_when_user_is_not_the_owner(AnswerOwner $answerOwner, Answer $answer)
    {
        $command = new DeleteAnswerCommand($this->answerId);

        $answerOwner->isSatisfiedBy($answer)->willReturn(false);
        $this->shouldThrow(InvalidAnswerOwner::class)
            ->during('handle', [$command]);
    }

    function it_throws_an_exception_when_answer_is_not_open(Answer $answer, AcceptedAnswer $acceptedAnswer)
    {
        $command = new DeleteAnswerCommand($this->answerId);

        $acceptedAnswer->isSatisfiedBy($answer)->willReturn(false);
        $this->shouldThrow(InvalidAnswerState::class)
            ->during('handle', [$command]);
    }
}
