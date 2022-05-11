<?php

namespace OmniaDigital\OmniaLibrary\Livewire;

use Illuminate\Support\Facades\Http;
use OmniaDigital\OmniaLibrary\DataTransferObjects\Place;

trait WithPlace
{
    public ?string $placeId = null;

    protected function placeApiKey(): ?string
    {
        return null;
    }

    protected function placeAdapter(): string
    {
        return 'google';
    }

    public function searchPlace(string $input, array $options = []): array
    {
        $params = array_merge($options, [
            'input' => $input,
            'key' => $this->placeApiKey() ?? config('library.place.google.api_key')
        ]);

        $response = Http::get('https://maps.googleapis.com/maps/api/place/autocomplete/json', $params);

        return $response->throw()->json();
    }

    public function findPlace(array $options = []): Place
    {
        $params = array_merge($options, [
            'place_id' => $this->placeId,
            'key' => config('services.google_maps.api_key', $this->placeApiKey())
        ]);

        $response = Http::get('https://maps.googleapis.com/maps/api/place/details/json', $params)
            ->throw()
            ->json();

        if ($response['status'] !== 'OK') {
            throw new \Exception($response['error_message'] ?? 'Cannot find place!');
        }

        return new Place($response['result']['address_components']);
    }
}
