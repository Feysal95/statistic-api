<?php

declare(strict_types=1);

namespace App\Tests\Api\Country;

use App\Tests\Api\BaseApiTestCase;

class CountryStatisticUpdateTest extends BaseApiTestCase
{
    public function testSuccessUpdate(): void
    {
        $client = static::createClient();
        $client->request('POST', 'api/statistics/countries', ['code' => 'RU']);

        $this->assertResponseStatusCodeSame(204);
        self::assertSame('', $client->getResponse()->getContent());
    }

    public function testUpdateWithInvalidCountry(): void
    {
        $client = static::createClient();
        $client->request('POST', 'api/statistics/countries', ['code' => 'ZZ']);

        $this->assertResponseStatusCodeSame(422);

        $this->assertApiValidationError(
            $this->getResponseJson($client),
            'Ошибка валидации',
            'This value is not a valid country.',
        );
    }
}
