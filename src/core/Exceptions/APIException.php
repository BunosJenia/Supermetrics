<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

/**
 * Class APIException
 */
class APIException extends \Exception
{
    private const ERROR_MESSAGE = "Supermetrics API error.";

    /**
     * APIException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = self::ERROR_MESSAGE, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
