import Image from '@tiptap/extension-image'
import { mergeAttributes } from '@tiptap/core'

export default Image.extend({
    name: 'custom-image',

    addOptions() {
        return {
            ...this.parent?.(),
            aligns: ['justify-center', 'justify-start', 'justify-end']
        }
    },

    addAttributes() {
        return {
            ...Image.config.addAttributes(),
            align: {
                default: 'justify-center',
                rendered: false
            },
            width: {
                rendered: true
            },
            height: {
                rendered: true
            }
        }
    },

    addCommands() {
        return {
            setImage: (options) => ({ tr, dispatch }) => {
                const { selection } = tr
                const node = this.type.create(options)

                if (dispatch) {
                    tr.replaceRangeWith(selection.from, selection.to, node)
                }

                return true
            },
            setImageAlign: (attributes) => ({ tr, dispatch }) => {
                // Check it's a valid align option
                if (!this.options.aligns.includes(attributes.align)) {
                    return false
                }

                const { selection } = tr

                const options = {
                    ...selection.node.attrs,
                    ...attributes
                }

                const node = this.type.create(options)

                if (dispatch) {
                    tr.replaceRangeWith(selection.from, selection.to, node)
                }
            }
        }
    },

    renderHTML({ node, HTMLAttributes }) {
        return [
            'div', {class: 'flex ' + node.attrs.align},
            ['img', mergeAttributes(this.options.HTMLAttributes, HTMLAttributes)]
        ]
    }
})
