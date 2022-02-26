@props([
    'default' => 1
])

<div
        x-data="{
            currentId: '',
            init() {
                // Set default step on page load.
                this.$nextTick(() => this.select(this.$id('step-wizard', '{{ $default }}')))
            },
            select(id) {
                this.currentId = id
            },
            handleCurrentStepPassed() {
                let totalStep = this.$refs.steplist.children.length;
                let currentStepNumber = parseInt(this.currentId.replace($el.id + '-', ''));
                let nextStepNumber = currentStepNumber + 1 > totalStep ? totalStep : currentStepNumber + 1;

                this.select(this.$id('step-wizard', nextStepNumber))
            },
            goToStep(id) {
                let currentStepNumber = parseInt(this.currentId.replace($el.id + '-', ''));
                let destinationStepNumber = parseInt(id.replace($el.id + '-', ''));

                // Go to previous step
                if (destinationStepNumber < currentStepNumber) {
                    this.select(id);

                    return;
                }

                // Go to itself, do nothing
                if (destinationStepNumber === currentStepNumber) {
                    return;
                }

                // Go to next step but only allow go one by one step.
                if (destinationStepNumber !== currentStepNumber + 1) {
                    return;
                }

                this.findLivewireStepComponent(currentStepNumber)?.call('submit');
            },
            findLivewireStepComponent(currentStepNumber) {
                // Find livewire component of the current step.
                currentPanelElement = this.$refs.stepPanels.children[currentStepNumber - 1];
                livewireComponentId = currentPanelElement.children[0]?.getAttribute('wire:id');

                return Livewire.find(livewireComponentId);
            },
            isCurrent(id) {
                return parseInt(id.replace($el.id + '-', '')) === parseInt(this.currentId.replace($el.id + '-', ''))
            },
            isCompleted(id) {
                return parseInt(id.replace($el.id + '-', '')) < parseInt(this.currentId.replace($el.id + '-', ''))
            },
            isUpcoming(id) {
                return parseInt(id.replace($el.id + '-', '')) > parseInt(this.currentId.replace($el.id + '-', ''))
            },
            whichChild(el, parent) {
                return Array.from(parent.children).indexOf(el) + 1;
            }
        }"
        x-id="['step-wizard']"
        x-on:current-step-passed.window="handleCurrentStepPassed"
        x-bind:id="$id('step-wizard')"
>
    <nav :aria-label="$id('step-wizard')">
        <ol x-ref="steplist" role="list" {{ $attributes->merge(['class' => 'space-y-4 md:flex md:space-y-0 md:space-x-8']) }}>
            {{ $items }}
        </ol>
    </nav>

    <div x-ref="stepPanels">
        {{ $panels }}
    </div>
</div>
