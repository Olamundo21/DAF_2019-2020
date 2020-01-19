<?php

namespace spec\App\Application\Questions;

use App\Application\Questions\AddQuestionCommand;
use App\Application\Questions\AddQuestionHandler;
use App\Domain\Events\EventPublisher;
use App\Domain\Questions\Question;
use App\Domain\Questions\QuestionsRepository;
use App\Domain\UserManagement\User\UserId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AddQuestionHandlerSpec extends ObjectBehavior
{

    private $userId;
    private $question;
    private $description;

    function let(QuestionsRepository $repository, EventPublisher $eventPublisher)
    {
        $this->userId = new UserId();
        $this->question = 'What?';
        $this->description = 'Else...';

        /** @var Question $question */
        $question = Argument::type(Question::class);
        $repository->add($question)->willReturnArgument(0);

        $this->beConstructedWith($repository, $eventPublisher);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AddQuestionHandler::class);
    }


    function it_handles_add_question_command(QuestionsRepository $repository, EventPublisher $eventPublisher)
    {
        $command = new AddQuestionCommand($this->userId, $this->question, $this->description);
        $question = $this->handle($command);
        $question->shouldBeAnInstanceOf(Question::class);

        $repository->add($question)->shouldHaveBeenCalled();
        $eventPublisher->publishEventsFrom($question)->shouldHaveBeenCalled();
    }
}
