<?php

namespace App\Application\Answers;

use App\Domain\Answers\Answer;
use App\Domain\Answers\AnswersRepository;
use App\Domain\Answers\Specification\AcceptedAnswer;
use App\Domain\Answers\Specification\AnswerOwner;
use App\Domain\Events\EventPublisher;
use App\Domain\Exception\InvalidAnswerOwner;
use App\Domain\Exception\InvalidAnswerState;
use App\Domain\Questions\Question;
use App\Domain\Questions\QuestionsRepository;
use App\Domain\UserManagement\User\UserId;
use Exception;

class EditAnswerHandler
{
    /**
     * @var AnswersRepository
     */
    private $answers;
    /**
     * @var AcceptedAnswer
     */
    private $acceptedAnswer;
    /**
     * @var AnswerOwner
     */
    private $answerOwner;
    /**
     * @var EventPublisher
     */
    private $eventPublisher;

    /**
     * Creates a EditAnswerHandler
     *
     * @param AnswersRepository $answers
     * @param AcceptedAnswer $acceptedAnswer
     * @param AnswerOwner $answerOwner
     * @param EventPublisher $eventPublisher
     */
    public function __construct(
        AnswersRepository $answers,
        AcceptedAnswer $acceptedAnswer,
        AnswerOwner $answerOwner,
        EventPublisher $eventPublisher
    ) {
        $this->answers = $answers;
        $this->acceptedAnswer = $acceptedAnswer;
        $this->answerOwner = $answerOwner;
        $this->eventPublisher = $eventPublisher;
    }

    /**
     * handle
     *
     * @param EditAnswerCommand $command
     *
     * @return Answer
     *
     * @throws Exception
     */
    public function handle(EditAnswerCommand $command): Answer
    {
        $answer = $this->answers->withId($command->answerId());

        if (!$this->answerOwner->isSatisfiedBy($answer)) {
            throw new InvalidAnswerOwner(
                "Only the answers's owner can edit this answer."
            );
        }

        if(!$this->acceptedAnswer->isSatisfiedBy($answer)) {
            throw new InvalidAnswerState(
                "It only possible to edit a answer given to a question, when the question is open. This question is already closed."
            );
        }

        $this->eventPublisher->publishEventsFrom(
            $this->answers->edit(
                $answer->edit($command->description())
            )
        );

        return $answer;
    }
}
