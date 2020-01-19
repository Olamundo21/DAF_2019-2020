<?php

/**
 * This file is part of forum-daf-2019 package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\Infrastructure\Persistence\Doctrine\Questions;

use App\Domain\Questions\Tag\TagId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Exception;

class DoctrineTagId extends StringType
{

    /**
     * convertToDatabaseValue
     *
     * @param TagId $value
     * @param AbstractPlatform $platform
     *
     * @return mixed|string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return (string) $value;
    }

    /**
     * convertToPHPValue
     *
     * @param string $value
     * @param AbstractPlatform $platform
     *
     * @return mixed|void
     * @throws Exception
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new TagId($value);
    }

    public function getName()
    {
        return 'TagId';
    }
}
