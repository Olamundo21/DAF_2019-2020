<?php

/**
 * This file is part of forum-daf-2019 package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\Infrastructure\Persistence\Doctrine\Questions;

use App\Domain\Questions\Tag;
use App\Domain\Questions\Tag\TagsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineTagsRepository implements TagsRepository
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Creates a DoctrineTagsRepository
     *
     * @param EntityManagerInterface|EntityManager $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritDoc
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Tag $tag): Tag
    {
        $this->entityManager->persist($tag);
        $this->entityManager->flush();
        return $tag;
    }

    /**
     * @inheritDoc
     * @throws \Doctrine\ORM\ORMException
     */
    public function remove(Tag $tag): void
    {
        $this->entityManager->remove($tag);
        $this->entityManager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getList(array $tags): Collection
    {
        $tags = new ArrayCollection();
        foreach ($tags as $tagDescription) {
            $checkTag = $this->withDescription($tagDescription);
            $tag = $checkTag ?: $this->add(new Tag($tagDescription));
            $tags->add($tag);
        }
        return $tags;
    }

    /**
     * @inheritDoc
     */
    public function withDescription(string $description): ?Tag
    {
        $repository = $this->entityManager->getRepository(Tag::class);
        /** @var Tag $tag */
        $tag = $repository->findOneBy(['description' => $description]);
        return $tag;
    }
}
