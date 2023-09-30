<?php

namespace OmniaDigital\OmniaLibrary\Livewire\v3;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait WithValidationFails
{
    private ?\Closure $whenFails = null;

    public function whenFails(\Closure $closure): self
    {
        $this->whenFails = $closure;

        return $this;
    }

    public function validate($rules = null, $messages = [], $attributes = [])
    {
        [$rules, $messages, $attributes] = $this->providedOrGlobalRulesMessagesAndAttributes($rules, $messages, $attributes);

        $data = $this->prepareForValidation(
            $this->getDataForValidation($rules)
        );

        $ruleKeysToShorten = $this->getModelAttributeRuleKeysToShorten($data, $rules);

        $data = $this->unwrapDataForValidation($data);

        $validator = Validator::make($data, $rules, $messages, $attributes);

        $this->shortenModelAttributesInsideValidator($ruleKeysToShorten, $validator);

        $validator->fails() && $this->handleFails($validator);

        $validatedData = $validator->validate();

        $this->resetErrorBag();

        return $validatedData;
    }

    private function handleFails($validator)
    {
        $this->whenFails && ($this->whenFails)($validator);

        throw new ValidationException($validator);
    }
}
