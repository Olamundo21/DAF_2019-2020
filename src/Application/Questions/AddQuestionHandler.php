<?php

namespace App\Application\Questions;

use App\Domain\Events\EventPublisher;
use App\Domain\Questions\Question;
use App\Domain\Questions\QuestionsRepository;
use Exception;

/**
 * Add Question Handler
 *
 * @package App\Application\Questions
 */
class AddQuestionHandler
{
    /**
     * @var QuestionsRepository
     */
    private $repository;
    /**
     * @var EventPublisher
     */
    private $eventPublisher;

    /**
     * Creates a AddQuestionHandler
     *
     * @param QuestionsRepository $repository
     * @param EventPublisher $eventPublisher
     */
    public function __construct(QuestionsRepository $repository, EventPublisher $eventPublisher)
    {
        $this->repository = $repository;
        $this->eventPublisher = $eventPublisher;
    }

    /**
     * Handles add question command
     *
     * @param AddQuestionCommand $command
     *
     * @return Question
     *
     * @throws Exception
     */
    public function handle(AddQuestionCommand $command): Question
    {
        $question = new Question(
            $command->userId(),
            $command->question(),
            $command->description()
        );

         $this->eventPublisher->publishEventsFrom($this->repository->add($question));
         return $question;
    }
}
