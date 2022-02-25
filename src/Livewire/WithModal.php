<?php

namespace OmniaDigital\OmniaLibrary\Livewire;

trait WithModal
{
    public function closeModal(string $modalId)
    {
        $this->dispatchBrowserEvent($modalId, ['type' => 'close']);
    }

    public function openModal(string $modalId)
    {
        $this->dispatchBrowserEvent($modalId, ['type' => 'open']);
    }
}
