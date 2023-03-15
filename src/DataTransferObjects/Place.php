<?php

namespace OmniaDigital\OmniaLibrary\DataTransferObjects;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class Place
{
    protected Collection $addressComponents;
    protected Collection $location;

    public function __construct(array $addressComponents, array $location = [])
    {
        $this->addressComponents = collect($addressComponents);
        $this->location = collect($location);
    }

    public function address(): string
    {
        $streetNumber = $this->addressComponents->first(fn ($component) => Arr::get($component, 'types.0') === 'street_number');
        $street = $this->addressComponents->first(fn ($component) => Arr::get($component, 'types.0') === 'route');

        return trim(($streetNumber['long_name'] ?? '') . ' ' . ($street['long_name'] ?? ''));
    }

    public function addressLine2(): string
    {
        return '';
    }

    public function postalCode(): string
    {
        $postalCode = $this->addressComponents->first(fn ($component) => Arr::get($component, 'types.0') === 'postal_code');

        return $postalCode['long_name'] ?? '';
    }

    public function city(): string
    {
        $city = $this->addressComponents->first(fn ($component) => Arr::get($component, 'types.0') === 'locality');

        return $city['long_name'] ?? '';
    }

    public function state(): string
    {
        $state = $this->addressComponents->first(fn ($component) => Arr::get($component, 'types.0') === 'administrative_area_level_1');

        return $state['short_name'] ?? '';
    }

    public function country(): string
    {
        $state = $this->addressComponents->first(fn ($component) => Arr::get($component, 'types.0') === 'country');

        return $state['short_name'] ?? '';
    }

    public function lat(): string
    {
        return $this->location?->lat ?? '';
    }

    public function lng(): string
    {
        return $this->location?->lng ?? '';
    }
}
