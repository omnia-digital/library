<?php

namespace OmniaDigital\OmniaLibrary\Livewire;

trait WithStripe
{
    public ?string $stripeToken = null;

    /**
     * Get billable instance.
     * Must define this method in Livewire component.
     */
    public function stripeBillable()
    {
        throw new \RuntimeException('Please define Stripe Billable via stripeBillable method.');
    }

    /**
     * Update Stripe payment method using Laravel Cashier.
     * @param string $event
     * @param string $message
     * @return array
     */
    public function updateStripePaymentMethod(string $event, string $message)
    {
        $this->validate(['stripeToken' => 'required|string|regex:/^pm/']);

        $billable = $this->stripeBillable();

        $billable->updateDefaultPaymentMethod($this->stripeToken);

        // Let Livewire knows Stripe payment method updated.
        $this->emitSelf('stripePaymentMethodUpdated', $billable);

        // Let Alpinejs now Stripe payment method updated.
        $this->dispatch('stripe-payment-method-updated');

        // Notify payment method was updated.
        $this->dispatch(
            empty($event) ? 'notify' : $event,
            type: 'success',
            message: empty($message) ? 'Your payment method was updated!' : $message,
        );

        return [
            'card_brand' => $billable->card_brand,
            'card_last_four' => $billable->card_last_four,
        ];
    }
}
