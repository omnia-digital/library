<?php

namespace OmniaDigital\OmniaLibrary\Livewire;

use Illuminate\Support\Arr;

trait WithStepWizard
{
    public function mountWithStepWizard()
    {
        $this->enableStepSessionData() && $this->fillSessionData();
    }

    public function submit(): void
    {
        $stepSessionData = $this->handle() ?? [];

        // Save session data of the current step component.
        if ($this->enableStepSessionData()) {
            $allSessionData = session()->get($this->getSessionDataKey(), []);

            session()->put($this->getSessionDataKey(), array_merge($allSessionData, $stepSessionData));
        }

        $this->dispatchBrowserEvent('current-step-passed');
    }

    protected function fillSessionData()
    {
        foreach ($this->getStepSessionData(default: []) as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    protected function getStepSessionData(?string $key = null, mixed $default = null): mixed
    {
        if (is_null($key)) {
            return session()->get($this->getSessionDataKey(), $default);
        }

        return Arr::get(session()->get($this->getSessionDataKey()), $key, $default);
    }

    protected function enableStepSessionData(): bool
    {
        return true;
    }

    protected function getSessionDataKey(): string
    {
        return 'step-session-data';
    }
}
