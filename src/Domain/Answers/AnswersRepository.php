<?php


namespace App\Domain\Answers;


use App\Domain\Answers\Answer\AnswerId;
use spec\App\Domain\Answers\Answer\AnswerIdSpec;

interface AnswersRepository
{
    /**
     * Adds a answer to the repository
     * @param Answer $answer
     * @return Answer
     */
    public function add(Answer $answer): Answer;

    /**
     * Retrieves the answer with the provided ID
     *
     * @param AnswerId $answerId
     * @return Answer
     */
    public function withId(AnswerId $answerId): Answer;

    /**
     * @param Answer $answer
     * @return Answer
     */
    public function edit(Answer $answer): Answer;

    /**
     * @param Answer $answer
     * @return void
     */
    public function remove(Answer $answer): void;
}