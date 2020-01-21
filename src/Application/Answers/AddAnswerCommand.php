<?php

namespace App\Application\Answers;

use App\Domain\Questions\Question\QuestionId;
use App\Domain\UserManagement\User\UserId;

class AddAnswerCommand
{
    private $userId;
    private $questionId;
    private $description;

    /**
     * AddAnswerCommand constructor.
     * @param UserId $userId
     * @param QuestionId $questionId
     * @param String $description
     */
    public function __construct(UserId $userId, QuestionId $questionId, String $description)
    {
        $this->userId = $userId;
        $this->questionId = $questionId;
        $this->description = $description;
    }

    public function questionId(): QuestionId
    {
        return $this->questionId;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }
}
