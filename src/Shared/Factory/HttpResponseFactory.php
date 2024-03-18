<?php

declare(strict_types=1);

namespace App\Shared\Factory;

use App\Shared\Factory\Dto\ExceptionResponseParamDto;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class HttpResponseFactory
{
    public function createFromErrorResponse(ExceptionResponseParamDto $exceptionResponseParam): Response
    {
        $responseBody = [];
        $responseBody['errors'] = [];
        foreach ($exceptionResponseParam->errorCollection->getErrors() as $apiPayloadError) {
            $errorData = [
                'status' => $apiPayloadError->status,
                'title' => $apiPayloadError->title,
                'detail' => $apiPayloadError->detail,
            ];

            if ($apiPayloadError->meta !== null) {
                $errorData['meta'] = $apiPayloadError->meta;
            }

            $responseBody['errors'][] = $errorData;
        }

        $response = new JsonResponse($responseBody, $exceptionResponseParam->status, $exceptionResponseParam->headers);

        $response->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        return $response;
    }
}
