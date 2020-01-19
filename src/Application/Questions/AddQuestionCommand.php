<?php

namespace App\Application\Questions;

use App\Domain\UserManagement\User\UserId;

class AddQuestionCommand
{
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var string
     */
    private $question;

    /**
     * @var string
     */
    private $description;

    /**
     * Creates a AddQuestionCommand
     *
     * @param UserId $userId
     * @param string $question
     * @param string $description
     */
    public function __construct(UserId $userId, string $question, string $description)
    {
        $this->userId = $userId;
        $this->question = $question;
        $this->description = $description;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function question(): string
    {
        return $this->question;
    }
}
