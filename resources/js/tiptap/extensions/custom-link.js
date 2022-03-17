import Link from "@tiptap/extension-link";

export default Link.extend({
    addKeyboardShortcuts() {
        return {
            'Mod-k': () => {
                // @TODO: Find a way to call showLinkModal method in tiptap.js
                const modalEvent = new CustomEvent('link-modal', {detail: {type: 'open'}});
                const modalDataEvent = new CustomEvent('link-data', {detail: {
                    href: this.editor.getAttributes('link').href ? this.editor.getAttributes('link').href : null,
                    target: this.editor.getAttributes('link').target ? this.editor.getAttributes('link').target : '_self'
                }});

                window.dispatchEvent(modalEvent);
                window.dispatchEvent(modalDataEvent);
            }
        }
    },
    addAttributes() {
        return {
            ...this.parent?.(),
            rel: {
                default: null,
                rendered: true
            },
        }
    },
})
