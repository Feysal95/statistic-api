<?php

declare(strict_types=1);

namespace App\Country\ArgumentResolver;

use App\Country\Service\Dto\CountryStatisticUpdateDto;
use App\Shared\Service\ValidatorService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

readonly class CountryStaticUpdateArgumentResolver implements ValueResolverInterface
{
    public function __construct(private ValidatorService $validatorService) {}

    /** @return iterable<CountryStatisticUpdateDto> */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if ($argument->getType() !== CountryStatisticUpdateDto::class) {
            return [];
        }

        $code = $request->request->get('code');

        $dto = new CountryStatisticUpdateDto($code);

        $this->validatorService->validate($dto);

        return [
            new CountryStatisticUpdateDto($code),
        ];
    }
}
