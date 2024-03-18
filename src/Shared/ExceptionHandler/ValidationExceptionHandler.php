<?php

declare(strict_types=1);

namespace App\Shared\ExceptionHandler;

use App\Shared\Exception\ConstraintValidationErrorException;
use App\Shared\Exception\InvalidArgumentException;
use App\Shared\Factory\Dto\ApiPayloadErrorDto;
use App\Shared\Factory\Dto\ExceptionResponseParamDto;
use App\Shared\Factory\Dto\PayloadErrorCollectionDto;
use JsonException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class ValidationExceptionHandler implements ExceptionHandlerInterface
{
    /**
     * @throws InvalidArgumentException
     * @throws JsonException
     */
    public function getOptions(Throwable $e, bool $debug): ExceptionResponseParamDto
    {
        if (!$e instanceof ConstraintValidationErrorException) {
            throw new InvalidArgumentException();
        }

        $status = Response::HTTP_UNPROCESSABLE_ENTITY;
        $errorCollection = new PayloadErrorCollectionDto();

        /** @var array<string, array<string>> $errorsData */
        $errorsData = json_decode($e->getMessage(), true, 512, JSON_THROW_ON_ERROR);

        foreach ($errorsData as $errorItem) {
            foreach ($errorItem as $errorText) {
                $errorCollection->addError(
                    new ApiPayloadErrorDto(
                        status: $status,
                        title: 'Ошибка валидации',
                        detail: $errorText,
                    ),
                );
            }
        }

        return ExceptionResponseParamDto::create($status, $errorCollection);
    }
}
