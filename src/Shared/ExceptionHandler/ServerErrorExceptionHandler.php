<?php

declare(strict_types=1);

namespace App\Shared\ExceptionHandler;

use App\Shared\Factory\Dto\ApiPayloadErrorDto;
use App\Shared\Factory\Dto\ExceptionResponseParamDto;
use JsonException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final readonly class ServerErrorExceptionHandler implements ExceptionHandlerInterface
{
    public function __construct(
        private LoggerInterface $logger,
    ) {}

    /** @throws JsonException */
    public function getOptions(Throwable $e, bool $debug): ExceptionResponseParamDto
    {
        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $meta = null;

        if ($debug) {
            $meta = [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ];
        }

        $error = ApiPayloadErrorDto::create(
            status: $status,
            title: 'Ошибка сервера',
            detail: $e->getMessage(),
            meta: $meta,
        );

        $this->logger->error(
            $e->getMessage(),
            [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'backtrace' => $e->getTrace(),
            ],
        );

        return ExceptionResponseParamDto::create($status, [$error]);
    }
}
