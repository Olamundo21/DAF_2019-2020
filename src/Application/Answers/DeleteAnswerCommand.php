<?php

namespace App\Application\Answers;

use App\Domain\Answers\Answer\AnswerId;

class DeleteAnswerCommand
{
    /**
     * @var AnswerId
     */
    private $answerId;

    /**
     * DeleteAnswerCommand constructor.
     * @param AnswerId $answerId
     */
    public function __construct(AnswerId $answerId)
    {
        $this->answerId = $answerId;
    }

    public function answerId()
    {
        return $this->answerId;
    }
}
