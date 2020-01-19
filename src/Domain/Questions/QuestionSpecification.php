<?php

/**
 * This file is part of forum-daf-2019 package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\Questions;

/**
 * QuestionSpecification
 *
 * @package App\Domain\Questions
 */
interface QuestionSpecification
{

    /**
     * Checks if the provided question satisfies current specification
     *
     * @param Question $question
     *
     * @return bool
     */
    public function isSatisfiedBy(Question $question): bool;
}
