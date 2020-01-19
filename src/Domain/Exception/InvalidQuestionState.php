<?php

/**
 * This file is part of forum-daf-2019 package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\Domain\Exception;

use App\Domain\DomainException;
use RuntimeException;

/**
 * InvalidQuestionState
 *
 * @package App\Domain\Exception
 */
class InvalidQuestionState extends RuntimeException implements DomainException
{

}
