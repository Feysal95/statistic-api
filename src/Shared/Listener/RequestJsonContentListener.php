<?php

declare(strict_types=1);

namespace App\Shared\Listener;

use JsonException;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class RequestJsonContentListener
{
    private const JSON_TYPE_HEADER = 'application/json';

    public function __invoke(ControllerEvent $event): void
    {
        $request = $event->getRequest();
        $contentType = $request->headers->get('Content-Type');

        if ($contentType !== self::JSON_TYPE_HEADER) {
            return;
        }

        try {
            $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $jsonException) {
            throw new BadRequestHttpException('Json parse error: ' . $jsonException->getMessage());
        }

        $request->request->replace(is_array($data) ? $data : []);
    }
}
