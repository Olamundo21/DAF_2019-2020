<?php


namespace App\Domain\Answers;


interface AnswerSpecification
{

    /**
     * Checks if the provided answer satisfies current specification
     *
     * @param Answer $answer
     *
     * @return bool
     */
    public function isSatisfiedBy(Answer $answer): bool;
}