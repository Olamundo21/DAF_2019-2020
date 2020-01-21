<?php


namespace App\Domain\Exception;


use App\Domain\DomainException;
use RuntimeException;

class InvalidAnswerState extends RuntimeException implements DomainException
{

}