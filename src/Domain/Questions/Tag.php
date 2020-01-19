<?php

namespace App\Domain\Questions;

use App\Domain\Questions\Tag\TagId;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * Tag
 *
 * @package App\Domain\Questions
 *
 * @ORM\Entity()
 * @ORM\Table(name="tags")
 */
class Tag
{

    /**
     * @var TagId
     *
     * @ORM\Id()
     * @ORM\Column(type="TagId", name="id")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $tagId;

    /**
     * @var string
     *
     * @ORM\Column()
     */
    private $description;

    /**
     * Creates a Tag
     *
     * @param string $description
     * @throws Exception
     */
    public function __construct(string $description)
    {
        $this->description = $description;
        $this->tagId = new TagId();
    }

    /**
     * tagId
     *
     * @return TagId
     */
    public function tagId(): TagId
    {
        return $this->tagId;
    }

    /**
     * description
     *
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }
}
