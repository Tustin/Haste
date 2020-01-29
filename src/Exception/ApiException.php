<?php

namespace Tustin\Haste\Exception;

use Tustin\Haste\Http\JsonStream;

class ApiException extends \Exception
{
    public function __construct(StreamInterface $stream)
    {
        // @TODO
    }
}