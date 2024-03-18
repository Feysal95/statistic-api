<?php

declare(strict_types=1);

namespace App\Shared\ExceptionHandler;

use App\Shared\Exception\InvalidArgumentException;
use App\Shared\Factory\Dto\ApiPayloadErrorDto;
use App\Shared\Factory\Dto\ExceptionResponseParamDto;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

final readonly class HttpExceptionHandler implements ExceptionHandlerInterface
{
    /** @throws InvalidArgumentException */
    public function getOptions(Throwable $e, bool $debug): ExceptionResponseParamDto
    {
        if (!$e instanceof HttpExceptionInterface) {
            throw new InvalidArgumentException();
        }

        $status = $e->getStatusCode();
        $error = ApiPayloadErrorDto::create(
            status: $status,
            title: 'Некорректный запрос',
            detail: $e->getMessage(),
        );

        return ExceptionResponseParamDto::create($status, [$error], $e->getHeaders());
    }
}
