<?php

declare(strict_types=1);

namespace App\Shared\Factory;

use App\Shared\Exception\ConstraintValidationErrorException;
use App\Shared\Exception\InvalidArgumentException;
use App\Shared\ExceptionHandler\HttpExceptionHandler;
use App\Shared\ExceptionHandler\ServerErrorExceptionHandler;
use App\Shared\ExceptionHandler\ValidationExceptionHandler;
use App\Shared\Factory\Dto\ExceptionResponseParamDto;
use JsonException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

final readonly class ExceptionResponseParamFactory
{
    public function __construct(
        private ValidationExceptionHandler $validationExceptionHandler,
        private HttpExceptionHandler $httpExceptionHandler,
        private ServerErrorExceptionHandler $serverErrorExceptionHandler,
    ) {}

    /**
     * @throws InvalidArgumentException
     * @throws JsonException
     */
    public function getParam(Throwable $e, bool $debug): ExceptionResponseParamDto
    {
        return match (true) {
            $e instanceof ConstraintValidationErrorException => $this->validationExceptionHandler->getOptions($e, $debug),
            $e instanceof HttpExceptionInterface => $this->httpExceptionHandler->getOptions($e, $debug),
            default => $this->serverErrorExceptionHandler->getOptions($e, $debug),
        };
    }
}
