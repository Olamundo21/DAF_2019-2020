<?php


namespace App\Domain\Exception;


use App\Domain\DomainException;
use RuntimeException;

class AnswerNotFound extends RuntimeException implements DomainException
{

}