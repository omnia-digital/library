<?php

namespace OmniaDigital\OmniaLibrary\Livewire;

trait WithInlineInput
{
    public $value;

    public bool $editMode = false;

    public function saveInlineData()
    {
        throw new \RuntimeException('Please implement saveInlineData method!');
    }

    public function model()
    {
        throw new \RuntimeException('Please implement model method!');
    }

    public function setEditMode()
    {
        $this->editMode = true;

        $this->dispatch('edit-mode',
            id: $this->model()->getKey(),
        );
    }

    public function submitInlineData()
    {
        $this->saveInlineData();

        $this->editMode = false;
    }
}
