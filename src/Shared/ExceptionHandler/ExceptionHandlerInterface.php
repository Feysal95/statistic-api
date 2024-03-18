<?php

declare(strict_types=1);

namespace App\Shared\ExceptionHandler;

use App\Shared\Factory\Dto\ExceptionResponseParamDto;
use Throwable;

interface ExceptionHandlerInterface
{
    public function getOptions(Throwable $e, bool $debug): ExceptionResponseParamDto;
}
