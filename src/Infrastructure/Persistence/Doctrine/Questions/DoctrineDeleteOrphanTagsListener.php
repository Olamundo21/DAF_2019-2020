<?php

/**
 * This file is part of forum-daf-2019 package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\Infrastructure\Persistence\Doctrine\Questions;

use App\Domain\Events\EventPublisher;
use App\Domain\Questions\EventListeners\DeleteOrphanTags;
use App\Domain\Questions\Tag;
use Doctrine\DBAL\Connection;

class DoctrineDeleteOrphanTagsListener extends DeleteOrphanTags
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * Creates a DoctrineDeleteOrphanTagsListener
     *
     * @param EventPublisher $eventPublisher
     * @param Connection $connection
     */
    function __construct(EventPublisher $eventPublisher, Connection $connection)
    {
        parent::__construct($eventPublisher);
        $this->connection = $connection;
    }

    /**
     * @inheritDoc
     */
    protected function deleteOrphanTags(): array
    {

    }
}
