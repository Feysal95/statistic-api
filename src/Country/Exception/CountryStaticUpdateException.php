<?php

declare(strict_types=1);

namespace App\Country\Exception;

use RuntimeException;
use Throwable;

class CountryStaticUpdateException extends RuntimeException
{
    private const MESSAGE = 'Failed to update country statistics: %s';
    private const CODE = 102;

    public function __construct(string $message, ?Throwable $previous = null)
    {
        $resultMessage = sprintf(self::MESSAGE, $message);

        parent::__construct($resultMessage, self::CODE, $previous);
    }
}
