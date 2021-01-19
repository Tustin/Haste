<?php

namespace Tustin\Haste\Exception;

use Tustin\Haste\Http\JsonStream;
use Psr\Http\Message\StreamInterface;

class ApiException extends \Exception
{
    /**
     * @param StreamInterface $stream
     */
    public function __construct($stream)
    {
        // @TODO
    }
}
