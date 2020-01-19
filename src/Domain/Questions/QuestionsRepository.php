<?php

/**
 * This file is part of forum-daf-2019 package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\Domain\Questions;

use App\Domain\Exception\QuestionNotFound;
use App\Domain\Questions\Question\QuestionId;

/**
 * QuestionsRepository
 *
 * @package App\Domain\Questions
 */
interface QuestionsRepository
{

    /**
     * Adds a question to the repository
     *
     * @param Question $question
     *
     * @return Question
     */
    public function add(Question $question): Question;

    /**
     * Retrieves the question with the provided ID
     *
     * @param QuestionId $questionId
     *
     * @return Question
     * @throws QuestionNotFound when there are no questions with the given ID
     */
    public function withId(QuestionId $questionId): Question;

    /**
     * Persists all changes on provided question entity
     *
     * @param Question $question
     *
     * @return Question
     */
    public function update(Question $question): Question;
}
