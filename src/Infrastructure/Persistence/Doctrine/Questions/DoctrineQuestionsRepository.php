<?php

/**
 * This file is part of forum-daf-2019 package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\Infrastructure\Persistence\Doctrine\Questions;

use App\Domain\Exception\QuestionNotFound;
use App\Domain\Questions\Question;
use App\Domain\Questions\Question\QuestionId;
use App\Domain\Questions\QuestionsRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\TransactionRequiredException;

class DoctrineQuestionsRepository implements QuestionsRepository
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Creates a DoctrineQuestionsRepository
     *
     * @param EntityManager|EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritDoc
     * @throws ORMException
     */
    public function add(Question $question): Question
    {
        $this->entityManager->persist($question);
        $this->entityManager->flush();
        return $question;
    }

    /**
     * @param QuestionId $questionId
     * @return Question
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws TransactionRequiredException
     */
    public function withId(QuestionId $questionId): Question
    {
        $question = $this->entityManager->find(Question::class, $questionId);

        if (!$question instanceof Question) {
            throw new QuestionNotFound("Question not found!");
        }

        return $question;
    }


    /**
     * @param Question $question
     * @return Question
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(Question $question): Question
    {
        $this->entityManager->flush($question);
        return $question;
    }


    /**
     * @param Question $question
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Question $question): void
    {
        $this->entityManager->remove($question);
        $this->entityManager->flush();
    }
}