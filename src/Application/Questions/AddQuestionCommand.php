<?php

namespace App\Application\Questions;

use App\Domain\UserManagement\User\UserId;

/**
 * AddQuestionCommand
 *
 * @package App\Application\Questions
 *
 * @OA\Schema(
 *     title="AddQuestion",
 *     schema="AddQuestion"
 * )
 */
class AddQuestionCommand
{
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var string
     * @OA\Property(example="What's for dinner tonigth?")
     */
    private $question;

    /**
     * @var string
     * @OA\Property(example="I am starving!!")
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

/**
 * @OA\RequestBody(
 *     request="AddQuestion",
 *     description="Object containing the very minimal information needded to create a question",
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/AddQuestion")
 * )
 */