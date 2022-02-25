document.addEventListener('alpine:init', () => {
    // Open Modal
    window.Alpine.magic('openModal', (el, {Alpine}) => {
        return function (modalId) {
            el.dispatchEvent(new CustomEvent(modalId, {
                bubbles: true,
                detail: {type: 'open'}
            }))
        }
    });

    // Close Modal
    window.Alpine.magic('closeModal', (el, {Alpine}) => {
        return function (modalId) {
            el.dispatchEvent(new CustomEvent(modalId, {
                bubbles: true,
                detail: {type: 'close'}
            }))
        }
    });
});
