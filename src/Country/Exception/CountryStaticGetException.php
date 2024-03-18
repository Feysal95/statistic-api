<?php

declare(strict_types=1);

namespace App\Country\Exception;

use RuntimeException;
use Throwable;

class CountryStaticGetException extends RuntimeException
{
    private const MESSAGE = 'Failed to get country statistics: %s';
    private const CODE = 101;

    public function __construct(string $message, ?Throwable $previous = null)
    {
        $resultMessage = sprintf(self::MESSAGE, $message);

        parent::__construct($resultMessage, self::CODE, $previous);
    }
}
