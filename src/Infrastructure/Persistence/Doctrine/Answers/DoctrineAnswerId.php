<?php


namespace App\Infrastructure\Persistence\Doctrine\Answers;


use App\Domain\Answers\Answer\AnswerId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Exception;

class DoctrineAnswerId extends StringType
{
    /**
     * ConvertsToDataBaseValue
     *
     * @param AnswerId $value
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
        return new AnswerId($value);
    }

    public function getName()
    {
        return 'AnswerId';
    }
}