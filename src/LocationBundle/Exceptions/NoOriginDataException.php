<?php

namespace LocationBundle\Exceptions;
use Throwable;
class NoOriginDataException extends LocationException
{
    public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
