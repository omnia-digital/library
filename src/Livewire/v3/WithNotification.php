<?php

namespace OmniaDigital\OmniaLibrary\Livewire\v3;

trait WithNotification
{
    public function success(string $message, ?array $action = null)
    {
        $this->dispatch('notify',
            message: $message,
            type:'success',
            action:$action,
        );
    }

    public function error(string $message, ?array $action = null)
    {
        $this->dispatch('notify',
            message: $message,
            type:'error',
            action:$action,
        );
    }

    public function info(string $message, ?array $action = null)
    {
        $this->dispatch('notify',
            message: $message,
            type:'info',
            action:$action,
        );
    }

    public function alertInvalidInput(?string $message = null)
    {
        $this->error($message ?? 'Please make sure all fields are input correctly.');
    }
}
