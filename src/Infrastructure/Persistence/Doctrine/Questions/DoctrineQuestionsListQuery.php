<?php

/**
 * This file is part of forum-daf-2019 package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\Infrastructure\Persistence\Doctrine\Questions;

use App\Application\Pagination;
use App\Application\QueryResult;
use App\Application\Questions\QuestionsListQuery;
use Doctrine\DBAL\Driver\Connection;

class DoctrineQuestionsListQuery extends QuestionsListQuery
{
    /**
     * @var Connection|\Doctrine\DBAL\Connection
     */
    private $connection;

    /**
     * Creates a DoctrineQuestionsListQuery
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @inheritDoc
     */
    public function data(array $attributes = []): QueryResult
    {
        $stm = $this->connection->createQueryBuilder()
            ->select('*')
            ->from('questions', 'q')
            ->setMaxResults(12)
            ->setFirstResult(0)
            ->execute();

        return new QueryResult($stm->fetchAll());
    }
}
