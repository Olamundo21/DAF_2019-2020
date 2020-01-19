<?php

/**
 * This file is part of S4Skeleton project
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Infrastructure\HttpKernel;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Oauth2Exception
 *
 * @package App\Infrastructure\HttpKernel
 */
class Oauth2Exception extends RuntimeException
{

    /**
     * @var Response
     */
    private $response;

    public function withResponse(Response $response): Oauth2Exception
    {
        $this->response = $response;
        return $this;
    }

    public function response(): Response
    {
        return $this->response;
    }
}
