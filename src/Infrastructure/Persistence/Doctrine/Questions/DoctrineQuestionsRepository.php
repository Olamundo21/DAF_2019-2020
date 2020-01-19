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
use Doctrine\ORM\ORMException;

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
     * @inheritDoc
     */
    public function withId(QuestionId $questionId): Question
    {
        // TODO: Implement withId() method.
    }

    /**
     * @inheritDoc
     */
    public function update(Question $question): Question
    {
        // TODO: Implement update() method.
    }
}
