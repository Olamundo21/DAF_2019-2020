<?php

namespace App\Application\Answers;

use App\Domain\Answers\Answer\AnswerId;


class EditAnswerCommand
{
    /**
     * @var AnswerId
     */
    private $answerId;
    /**
     * @var string
     */
    private $description;


    /**
     * EditAnswerCommand constructor.
     * @param AnswerId $answerId
     * @param string $description
     */
    public function __construct(AnswerId $answerId, string $description)
    {
        $this->answerId = $answerId;
        $this->description = $description;
    }

    public function answerId()
    {
        return $this->answerId;
    }

    public function description()
    {
        return $this->description;
    }
}
