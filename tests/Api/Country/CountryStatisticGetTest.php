<?php

declare(strict_types=1);

namespace App\Tests\Api\Country;

use App\Country\Repository\CountryStatisticRepositoryInterface;
use App\Tests\Api\BaseApiTestCase;

class CountryStatisticGetTest extends BaseApiTestCase
{
    public function testSuccessGet(): void
    {
        $countryStatisticRepositoryMock = $this->createMock(CountryStatisticRepositoryInterface::class);
        $countryStatisticRepositoryMock->method('getAll')
            ->willReturn(['RU' => 100, 'US' => 200, 'GB' => 150])
        ;

        $client = static::createClient();

        $client->getContainer()->set(CountryStatisticRepositoryInterface::class, $countryStatisticRepositoryMock);

        $client->request('GET', '/api/statistics/countries');

        $response = $client->getResponse();

        self::assertSame(200, $response->getStatusCode());

        $response = $this->getResponseJson($client);

        self::assertSame([
            'RU' => 100,
            'US' => 200,
            'GB' => 150,
        ], $response);
    }
}
