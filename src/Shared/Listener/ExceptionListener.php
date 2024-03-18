<?php

declare(strict_types=1);

namespace App\Shared\Listener;

use App\Shared\Factory\ExceptionResponseParamFactory;
use App\Shared\Factory\HttpResponseFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final readonly class ExceptionListener
{
    public function __construct(
        private bool $debug,
        private HttpResponseFactory $httpResponseFactory,
        private ExceptionResponseParamFactory $exceptionResponseParamsFactory,
    ) {}

    public function __invoke(ExceptionEvent $event): void
    {
        $httpResponse = $this->getResponse($event);
        $event->setResponse($httpResponse);
    }

    private function getResponse(ExceptionEvent $event): Response
    {
        $exception = $event->getThrowable();

        $exceptionParam = $this->exceptionResponseParamsFactory->getParam($exception, $this->debug);

        return $this->httpResponseFactory->createFromErrorResponse($exceptionParam);
    }
}
