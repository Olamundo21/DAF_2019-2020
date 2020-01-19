<?php

namespace App\Domain\Questions\Specification;

use App\Domain\Questions\Question;
use App\Domain\Questions\QuestionSpecification;

class OpenQuestion implements QuestionSpecification
{
    /**
     * @inheritDoc
     */
    public function isSatisfiedBy(Question $question): bool
    {
        return $question->isOpen();
    }
}
