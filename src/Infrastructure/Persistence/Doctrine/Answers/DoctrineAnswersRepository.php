<?php


namespace App\Infrastructure\Persistence\Doctrine\Answers;


use App\Domain\Answers\Answer;
use App\Domain\Answers\Answer\AnswerId;
use App\Domain\Answers\AnswersRepository;
use App\Domain\Exception\AnswerNotFound;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException as ORMException;
use Doctrine\ORM\TransactionRequiredException;


class DoctrineAnswersRepository implements AnswersRepository
{
    /**
     * @var EntityManager|EntityManagerInterface
     */
    private $entityManager;

    /**
     * Creates a DoctrineAnswersRepository
     *
     * @param EntityManager|EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Adds an answer to the questions repository
     *
     * @param Answer $answer
     * @return Answer
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Answer $answer): Answer
    {
        $this->entityManager->persist($answer);
        $this->entityManager->flush();
        return $answer;
    }

    /**
     * @param AnswerId $answerId
     * @return Answer
     *
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     * @throws AnswerNotFound if no answer was found with the provided ID
     */
    public function withId(AnswerId $answerId): Answer
    {
        $answer = $this->entityManager->find(Answer::class, $answerId);

        if (!$answer instanceof Answer) {
            throw new AnswerNotFound("Answer not found!");
        }

        return $answer;
    }

    /**
     * Removes an answer from the answers repository
     *
     * @param Answer $answer
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Answer $answer): void
    {
        $this->entityManager->remove($answer);
        $this->entityManager->flush();
    }

    /**
     * @inheritDoc
     */
    public function edit(Answer $answer): Answer
    {
        $this->entityManager->flush($answer);
        return $answer;
    }
}