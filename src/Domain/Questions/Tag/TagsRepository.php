<?php

/**
 * This file is part of forum-daf-2019 package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\Domain\Questions\Tag;

use App\Domain\Questions\Tag;
use Doctrine\Common\Collections\Collection;

interface TagsRepository
{

    /**
     * Adds a tag to the repository
     *
     * @param Tag $tag
     *
     * @return Tag
     */
    public function add(Tag $tag): Tag;

    /**
     * Removes a tag from repository
     *
     * @param Tag $tag
     */
    public function remove(Tag $tag): void;

    /**
     * Returns a collection of tags entities based on description's list passed as argument.
     *
     * If the tag does not exist it will be created, returning the existent tag otherwise.
     *
     * @param array $tags
     *
     * @return Collection
     */
    public function getList(array $tags): Collection;

    /**
     * Retrieves the tag that has the provided description
     *
     * @param string $description
     *
     * @return Tag|null
     */
    public function withDescription(string $description): ?Tag;
}
