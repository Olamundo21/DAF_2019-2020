<?php

namespace App\Application\Answers;

use App\Domain\Answers\AnswerSpecification;
use App\Domain\Answers\AnswersRepository;
use App\Domain\Answers\Specification\AcceptedAnswer;
use App\Domain\Answers\Specification\AnswerOwner;
use App\Domain\Events\EventPublisher;
use App\Domain\Exception\InvalidAnswerOwner;
use App\Domain\Exception\InvalidAnswerState;

class DeleteAnswerHandler
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
     * DeleteAnswerHandler constructor.
     * @param AnswersRepository $answers
     * @param AcceptedAnswer $acceptedAnswer
     * @param AnswerOwner $answerOwner
     * @param EventPublisher $eventPublisher
     */
    public function __construct(AnswersRepository $answers, AcceptedAnswer $acceptedAnswer, AnswerOwner $answerOwner, EventPublisher $eventPublisher)
    {

        $this->answers = $answers;
        $this->acceptedAnswer = $acceptedAnswer;
        $this->answerOwner = $answerOwner;
        $this->eventPublisher = $eventPublisher;
    }

    public function handle(DeleteAnswerCommand $command)
    {
        $answer = $this->answers->withId($command->answerId());

        if (!$this->answerOwner->isSatisfiedBy($answer)) {
            throw new InvalidAnswerOwner(
                "Only the answers's owner can delete this answer."
            );
        }

        if(!$this->acceptedAnswer->isSatisfiedBy($answer)) {
            throw new InvalidAnswerState(
                "It only possible to delete a answer given to a question, when the question is open. This question is already closed."
            );
        }

        $this->eventPublisher->publishEventsFrom(
            $this->answers->remove($answer));
    }
}
