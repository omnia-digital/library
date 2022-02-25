import tippy from 'tippy.js';

document.addEventListener('alpine:init', () => {
    window.Alpine.magic('openModal', (el, {Alpine}) => {
        return function (modalId) {
            el.dispatchEvent(new CustomEvent(modalId, {
                bubbles: true,
                detail: {type: 'open'}
            }))
        }
    });

    window.Alpine.magic('closeModal', (el, {Alpine}) => {
        return function (modalId) {
            el.dispatchEvent(new CustomEvent(modalId, {
                bubbles: true,
                detail: {type: 'close'}
            }))
        }
    });

    // Magic: $tooltip
    window.Alpine.magic('tooltip', el => message => {
        let instance = tippy(el, {content: message, trigger: 'manual'})

        instance.show()

        setTimeout(() => {
            instance.hide()

            setTimeout(() => instance.destroy(), 150)
        }, 2000)
    })

    // Directive: x-tooltip
    window.Alpine.directive('tooltip', (el, {expression}) => {
        tippy(el, {content: expression})
    })
});
