<?php


namespace App\Domain\Exception;


use App\Domain\DomainException;
use RuntimeException;

class InvalidAnswerOwner extends RuntimeException implements DomainException
{

}