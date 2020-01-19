<?php

namespace App\Domain\Questions;

use App\Domain\Events\EventGenerator;
use App\Domain\Events\EventGeneratorMethods;
use App\Domain\Questions\Events\QuestionWasCreated;
use App\Domain\Questions\Events\QuestionWasEdited;
use App\Domain\Questions\Events\TagsWereUpdated;
use App\Domain\Questions\Question\QuestionId;
use App\Domain\UserManagement\User\UserId;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * Question
 *
 * @package App\Domain\Questions
 *
 * @ORM\Entity()
 * @ORM\Table(name="questions")
 */
class Question implements EventGenerator
{
    use EventGeneratorMethods;

    /**
     * @var QuestionId
     *
     * @ORM\Id()
     * @ORM\Column(type="QuestionId", name="id")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $questionId;

    /**
     * @var UserId
     *
     * @ORM\Column(type="UserId", name="user_id")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column()
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column()
     */
    private $description;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable")
     */
    private $appliedOn;

    /**
     * @var bool
     *
     * @ORM\Column()
     */
    private $open = true;

    /**
     * @var DateTimeImmutable
     *
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $lastEditedOn;

    /**
     * @var ArrayCollection|Tag[]
     * @ORM\ManyToMany(targetEntity="Tag")
     * @ORM\JoinTable(name="question_tags",
     *      joinColumns={@ORM\JoinColumn(name="question_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     */
    private $tags;

    /**
     * Creates a Question
     *
     * @param UserId $userId
     * @param string $question
     * @param string $description
     *
     * @throws Exception
     */
    public function __construct(UserId $userId, string $question, string $description)
    {
        $this->questionId = new QuestionId();
        $this->userId = $userId;
        $this->question = $question;
        $this->description = $description;
        $this->appliedOn = new DateTimeImmutable();
        $this->tags = new ArrayCollection();
        $this->recordThat(new QuestionWasCreated($this));
    }

    /**
     * Question identifier
     *
     * @return QuestionId
     */
    public function questionId(): QuestionId
    {
        return $this->questionId;
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

    public function appliedOn(): DateTimeImmutable
    {
        return $this->appliedOn;
    }

    public function isOpen(): bool
    {
        return $this->open;
    }

    /**
     * edit
     *
     * @param string $question
     * @param string $description
     *
     * @return Question
     *
     * @throws Exception
     */
    public function edit(string $question, string $description): Question
    {
        $this->question = $question;
        $this->description = $description;
        $this->lastEditedOn = new DateTimeImmutable();
        $this->recordThat(new QuestionWasEdited($this->questionId, $question, $description));
        return $this;
    }

    public function lastEditedOn(): ?DateTimeImmutable
    {
        return $this->lastEditedOn;
    }

    /**
     * tags
     *
     * @return ArrayCollection
     */
    public function tags(): ArrayCollection
    {
        return $this->tags;
    }

    /**
     * Updates question tags
     *
     * @param Collection $tags
     *
     * @return Question
     */
    public function updateTags(Collection $tags): Question
    {
        $this->tags = $tags;
        $this->recordThat(new TagsWereUpdated($this->questionId, $tags));
        return $this;
    }
}
