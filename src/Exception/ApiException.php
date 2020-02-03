<?php

namespace Tustin\Haste\Exception;

use Tustin\Haste\Http\JsonStream;
use Psr\Http\Message\StreamInterface;

class ApiException extends \Exception
{
    public function __construct(StreamInterface $stream)
    {
        // @TODO
    }
}