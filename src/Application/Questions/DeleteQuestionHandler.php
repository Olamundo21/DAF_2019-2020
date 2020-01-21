<?php

namespace App\Application\Questions;

use App\Application\Answers\DeleteAnswerCommand;
use App\Domain\Events\EventPublisher;
use App\Domain\Exception\InvalidQuestionOwner;
use App\Domain\Exception\InvalidQuestionState;
use App\Domain\Questions\Question;
use App\Domain\Questions\QuestionsRepository;
use App\Domain\Questions\Specification\OpenQuestion;
use App\Domain\Questions\Specification\QuestionOwner;
use phpDocumentor\Reflection\Types\This;

class DeleteQuestionHandler
{
    /**
     * @var QuestionsRepository
     */
    private $questions;
    /**
     * @var OpenQuestion
     */
    private $openQuestion;
    /**
     * @var QuestionOwner
     */
    private $questionOwner;
    /**
     * @var EventPublisher
     */
    private $eventPublisher;

    /**
     * DeleteQuestionHandler constructor.
     * @param QuestionsRepository $questions
     * @param OpenQuestion $openQuestion
     * @param QuestionOwner $questionOwner
     * @param EventPublisher $eventPublisher
     */
    public function __construct(QuestionsRepository $questions, OpenQuestion $openQuestion, QuestionOwner $questionOwner, EventPublisher $eventPublisher)
    {
        $this->questions = $questions;
        $this->openQuestion = $openQuestion;
        $this->questionOwner = $questionOwner;
        $this->eventPublisher = $eventPublisher;
    }

    public function handle(DeleteQuestionCommand $command)
    {
        $question = $this->questions->withId($command->questionId());

        if (!$this->questionOwner->isSatisfiedBy($question)) {
            throw new InvalidQuestionOwner(
                "Only the question's owner can delete this question."
            );
        }

        if (!$this->openQuestion->isSatisfiedBy($question)) {
            throw new InvalidQuestionState(
                "It only possible to delete a question when the question is open. This question is already closed."
            );
        }

        $this->eventPublisher->publishEventsFrom(
            $this->questions->remove($question));
    }
}
