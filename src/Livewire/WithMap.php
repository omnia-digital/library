<?php

namespace OmniaDigital\OmniaLibrary\Livewire;

trait WithMap
{
    public function addPlaces(string $mapId, array $places)
    {
        $this->dispatchBrowserEvent($mapId, [
            'type' => 'loadPlaces',
            'places' => $this->formatPlaces($places),
        ]);
    }

    public function flyTo(string $mapId, string $lng, string $lat)
    {
        $this->dispatchBrowserEvent($mapId, [
            'type' => 'fly',
            'coordinate' => [$lng, $lat],
        ]);
    }

    public function formatPlaces(array $places): array
    {
        return collect($places)->map(function ($place) {
            return [
                'type' => 'Feature',
                'properties' => [
                    'id' => $place['id'],
                    'description' => $place['description'] ?? $place['name'],
                    'icon' => $place['icon'] ?? 'rocket-15',
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$place['lng'], $place['lat']],
                ],
            ];
        })->all();
    }

    public function showPlaceDetail($placeId) {

    }
}
