<?php

declare(strict_types=1);

namespace App\Tests\Api;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class BaseApiTestCase extends WebTestCase
{
    protected function assertApiValidationError(
        array $decodedResponse,
        string $title,
        ?string $detailError = null,
    ): void {
        self::assertArrayHasKey('errors', $decodedResponse);
        self::assertIsArray($decodedResponse['errors']);

        foreach ($decodedResponse['errors'] as $error) {
            if ($error['title'] === $title && (!$detailError || $detailError === $error['detail'])) {
                self::assertArrayHasKey('status', $error);
                self::assertArrayHasKey('title', $error);
                self::assertArrayHasKey('detail', $error);

                $this->addToAssertionCount(1);

                return;
            }
        }

        self::fail("Ошибка с title: {$title} не найдена. " . var_export($decodedResponse, true));
    }

    protected function getResponseJson(KernelBrowser $browser): ?array
    {
        return json_decode($browser->getResponse()->getContent(), true, 512, JSON_THROW_ON_ERROR);
    }
}
