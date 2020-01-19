<?php

namespace App\Application\Questions;

use App\Domain\Questions\Question\QuestionId;
use App\Domain\Questions\Tag;

class UpdateTagsCommand
{
    /**
     * @var QuestionId
     */
    private $questionId;
    /**
     * @var Tag[]|array
     */
    private $tags;

    /**
     * Creates a UpdateTagsCommand
     *
     * @param QuestionId $questionId
     * @param array|Tag[] $tags
     */
    public function __construct(QuestionId $questionId, array $tags)
    {
        $this->questionId = $questionId;
        $this->tags = $tags;
    }

    /**
     * questionId
     *
     * @return QuestionId
     */
    public function questionId(): QuestionId
    {
        return $this->questionId;
    }

    /**
     * tags
     *
     * @return array|Tag[]
     */
    public function tags(): array
    {
        return $this->tags;
    }
}
