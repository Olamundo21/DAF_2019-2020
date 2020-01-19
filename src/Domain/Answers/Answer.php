<?php

namespace App\Domain\Answers;

use App\Domain\Answers\Answer\AnswerId;
use App\Domain\Answers\Events\AnswerWasCreated;
use App\Domain\Answers\Events\AnswerWasEdited;
use App\Domain\Events\EventGenerator;
use App\Domain\Events\EventGeneratorMethods;
use App\Domain\UserManagement\User\UserId;
use DateTimeImmutable;
use Exception;
use phpDocumentor\Reflection\DocBlock\Description;

class Answer implements EventGenerator
{
    use EventGeneratorMethods;

    /**
     * @var string
     */
    private $description;
    /**
     * @var UserId
     */
    private $userId;
    /**
     * @var DateTimeImmutable
     */
    private $appliedOn;

    /**
     * @var bool
     */
    private $accepted = true;

    /**
     * @var DateTimeImmutable
     *
     */
    private $lastEditedOn;
    /**
     * @var
     */
    private $answerId;

    /**
     * Creates a Answer
     *
     * @param UserId $userId
     * @param string $description
     *
     * @throws Exception
     */
    public function __construct(UserId $userId, string $description)
    {
        $this->answerId = new answerId();
        $this->userId = $userId;
        $this->description = $description;
        $this->appliedOn = new DateTimeImmutable();
        $this->recordThat(new AnswerWasCreated($this));
    }

    public function answerId()
    {
        return $this->answerId;
    }

    public function questionId()
    {
        return $this->questionId;
    }

    public function description()
    {
        return $this->description;
    }

    public function appliedOn(): DateTimeImmutable
    {
        return $this->appliedOn;
    }

    public function isAccepted(): bool
    {
        return $this->accepted;
    }

    public function lastEditedOn(): ?DateTimeImmutable
    {
        return $this->lastEditedOn;
    }

    /**
     * Edit Answer
     *
     * @param string $description
     *
     * @return Answer
     *
     * @throws Exception
     */
    public function edit(string $description): Answer
    {
        $this->description = $description;
        $this->lastEditedOn = new DateTimeImmutable();
        $this->recordThat(new AnswerWasEdited($this->answerId, $description));
        return $this;
    }
}
