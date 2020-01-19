<?php

namespace App\Application\Questions;

use App\Domain\Events\EventPublisher;
use App\Domain\Exception\InvalidQuestionOwner;
use App\Domain\Exception\InvalidQuestionState;
use App\Domain\Questions\Question;
use App\Domain\Questions\QuestionsRepository;
use App\Domain\Questions\Specification\OpenQuestion;
use App\Domain\Questions\Specification\QuestionOwner;
use App\Domain\Questions\Tag\TagsRepository;

class UpdateTagsHandler
{
    /**
     * @var QuestionsRepository
     */
    private $questions;
    /**
     * @var TagsRepository
     */
    private $tagsRepository;
    /**
     * @var EventPublisher
     */
    private $eventPublisher;
    /**
     * @var QuestionOwner
     */
    private $questionOwner;
    /**
     * @var OpenQuestion
     */
    private $openQuestion;

    /**
     * Creates a UpdateTagsHandler
     *
     * @param QuestionsRepository $questions
     * @param TagsRepository $tagsRepository
     * @param EventPublisher $eventPublisher
     * @param QuestionOwner $questionOwner
     * @param OpenQuestion $openQuestion
     */
    public function __construct(
        QuestionsRepository $questions,
        TagsRepository $tagsRepository,
        EventPublisher $eventPublisher,
        QuestionOwner $questionOwner,
        OpenQuestion$openQuestion
    ) {
        $this->questions = $questions;
        $this->tagsRepository = $tagsRepository;
        $this->eventPublisher = $eventPublisher;
        $this->questionOwner = $questionOwner;
        $this->openQuestion = $openQuestion;
    }

    /**
     * handle
     *
     * @param UpdateTagsCommand $command
     *
     * @return Question
     */
    public function handle(UpdateTagsCommand $command): Question
    {
        $question = $this->questions->withId($command->questionId());

        if (!$this->questionOwner->isSatisfiedBy($question)) {
            throw new InvalidQuestionOwner(
                "You cannot make changes to a question that don't belongs to you."
            );
        }

        if (!$this->openQuestion->isSatisfiedBy($question)) {
            throw new InvalidQuestionState(
                "You cannot change the question. It's already closed."
            );
        }

        $tags = $this->tagsRepository->getList($command->tags());
        $this->eventPublisher->publishEventsFrom(
            $this->questions->update(
                $question->updateTags($tags)
            )
        );
        return $question;
    }
}
