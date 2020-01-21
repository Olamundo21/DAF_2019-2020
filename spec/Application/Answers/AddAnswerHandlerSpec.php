<?php

namespace spec\App\Application\Answers;

use App\Application\Answers\AddAnswerCommand;
use App\Application\Answers\AddAnswerHandler;
use App\Domain\Answers\Answer;
use App\Domain\Answers\AnswersRepository;
use App\Domain\Events\EventPublisher;
use App\Domain\Questions\Question\QuestionId;
use App\Domain\UserManagement\User\UserId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AddAnswerHandlerSpec extends ObjectBehavior
{
    private $questionId;
    private $userId;
    private $description;

    function let(AnswersRepository $repository, EventPublisher $eventPublisher)
    {
        $this->userId = new UserId();
        $this->questionId = new QuestionId();
        $this->description = 'Answer nice';

        /** @var Answer $description */
        $description = Argument::type(Answer::class);
        $repository->add($description)->willReturnArgument(0);

        $this->beConstructedWith($repository, $eventPublisher);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType(AddAnswerHandler::class);
    }

    function it_handles_add_answer_command(AnswersRepository $repository, EventPublisher $eventPublisher)
    {
        $command = new AddAnswerCommand($this->userId, $this->questionId, $this->description);
        $description = $this->handle($command);
        $description->shouldBeAnInstanceOf(Answer::class);

        $repository->add($description)->shouldHaveBeenCalled();
        $eventPublisher->publishEventsFrom($description)->shouldHaveBeenCalled();
    }
}
