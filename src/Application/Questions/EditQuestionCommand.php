<?php

namespace App\Application\Questions;

use App\Domain\Questions\Question\QuestionId;

class EditQuestionCommand
{
    /**
     * @var string
     */
    private $question;

    /**
     * @var string
     */
    private $description;

    /**
     * @var QuestionId
     */
    private $questionId;

    /**
     * Creates a EditQuestionCommand
     *
     * @param QuestionId $questionId
     * @param string $question
     * @param string $description
     */
    public function __construct(QuestionId $questionId, string $question, string $description)
    {
        $this->question = $question;
        $this->description = $description;
        $this->questionId = $questionId;
    }

    /**
     * question
     *
     * @return string
     */
    public function question(): string
    {
        return $this->question;
    }

    /**
     * description
     *
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }

    public function questionId(): QuestionId
    {
        return $this->questionId;
    }
}
