<?php

namespace OmniaDigital\OmniaLibrary\Livewire;

trait WithModal
{
    public function closeModal(string $modalId)
    {
        $this->dispatch($modalId, type: 'close');
    }

    public function openModal(string $modalId)
    {
        $this->dispatch($modalId, type: 'open');
    }
}
