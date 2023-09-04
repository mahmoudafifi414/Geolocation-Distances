<?php

namespace LocationBundle\Exceptions;

use Throwable;

abstract class LocationException extends \Exception
{
    /**
     * @param $message
     * @param $code
     * @param Throwable|null $previous
     */
    public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
