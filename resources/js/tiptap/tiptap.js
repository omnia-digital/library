import {Editor} from '@tiptap/core'
import StarterKit from '@tiptap/starter-kit'
import CustomImage from './extensions/custom-image'
import CustomLink from './extensions/custom-link'
import Table from '@tiptap/extension-table'
import TableRow from '@tiptap/extension-table-row'
import TableCell from '@tiptap/extension-table-cell'
import TableHeader from '@tiptap/extension-table-header'
import Underline from "@tiptap/extension-underline"
import {TextAlign} from "@tiptap/extension-text-align"
import {BubbleMenu} from "@tiptap/extension-bubble-menu"
import {FloatingMenu} from "@tiptap/extension-floating-menu"
import CodeBlockLowlight from '@tiptap/extension-code-block-lowlight'
import lowlight from 'lowlight'
import CharacterCount from '@tiptap/extension-character-count'
import Placeholder from '@tiptap/extension-placeholder'

// Tiptap editor on alpine init
document.addEventListener('alpine:init', () => {
    window.Alpine.data('tiptap', () => {
        let editor;
        const editorMediaManagerId = 'tiptap'

        return {
            // Passing updatedAt here to make Alpine re-render the menu buttons.
            // The value of updatedAt will be updated on every Tiptap transaction.
            isActive(type, opts = {}, updatedAt) {
                if (!type || type === 'false') {
                    return false;
                }

                return editor.isActive(type, opts);
            },
            showImageModal() {
                this.$wire.emitTo(
                    'media-manager',
                    'media-manager:show',
                    {
                        id: editorMediaManagerId,
                        file: this.editor().getAttributes('custom-image').src ? this.editor().getAttributes('custom-image').src : null,
                        metadata: {
                            alt: this.editor().getAttributes('custom-image').alt ? this.editor().getAttributes('custom-image').alt : null
                        }
                    }
                );
            },
            showLinkModal() {
                this.$dispatch('link-modal', {type: 'open'});
                this.$dispatch('link-data', {
                    href: this.editor().getAttributes('link').href ? this.editor().getAttributes('link').href : null,
                    target: this.editor().getAttributes('link').target ? this.editor().getAttributes('link').target : '_self',
                    rel: this.editor().getAttributes('link').rel ? this.editor().getAttributes('link').rel : null
                });
            },
            updatedAt: Date.now(),
            editor: () => editor,
            init() {
                const _this = this;

                editor = new Editor({
                    element: this.$refs.editorReference,
                    extensions: [
                        StarterKit.configure({
                            codeBlock: false,
                        }),
                        Underline,
                        CustomImage,
                        CustomLink.configure({
                            HTMLAttributes: {
                                rel: null,
                            },
                            openOnClick: false,
                        }),
                        CodeBlockLowlight.configure({
                            lowlight,
                        }),
                        Table.configure({
                            HTMLAttributes: {
                                class: 'dklog-table',
                            },
                            resizable: true,
                        }),
                        TableRow,
                        TableHeader,
                        TableCell,
                        TextAlign.configure({
                            types: ['heading', 'paragraph', 'image'],
                        }),
                        BubbleMenu.configure({
                            pluginKey: 'bubbleMenu',
                            element: document.querySelector('#bubble-menu'),
                            tippyOptions: {
                                theme: 'light',
                            },
                            shouldShow: ({editor, view, state, oldState, from, to}) => {
                                // Only show when selecting a paragraph.
                                return !editor.view.state.selection.empty && editor.isActive('paragraph');
                            },
                        }),
                        BubbleMenu.configure({
                            pluginKey: 'bubbleMenuForImage',
                            element: document.querySelector('#bubble-menu-for-image'),
                            tippyOptions: {
                                theme: 'light',
                            },
                            shouldShow: ({editor, view, state, oldState, from, to}) => {
                                return editor.isActive('custom-image');
                            },
                        }),
                        BubbleMenu.configure({
                            pluginKey: 'bubbleMenuForTable',
                            element: document.querySelector('#bubble-menu-for-table'),
                            tippyOptions: {
                                theme: 'light',
                            },
                            shouldShow: ({editor, view, state, oldState, from, to}) => {
                                return editor.view.state.selection.empty && editor.isActive('table');
                            },
                        }),
                        BubbleMenu.configure({
                            pluginKey: 'bubbleMenuForMergeSplitCells',
                            element: document.querySelector('#bubble-menu-for-merge-split-cells'),
                            tippyOptions: {
                                theme: 'light',
                            },
                            shouldShow: ({editor, view, state, oldState, from, to}) => {
                                return editor.can().mergeOrSplit();
                            },
                        }),
                        FloatingMenu.configure({
                            element: document.querySelector('#floating-menu'),
                            tippyOptions: {
                                theme: 'light',
                            }
                        }),
                        CharacterCount.configure({
                            limit: this.characterLimit ? this.characterLimit : null,
                            mode: 'textSize',
                        }),
                        Placeholder.configure({
                            emptyEditorClass: this.placeholderClass,
                            placeholder: this.placeholderText,
                        })
                    ],
                    editorProps: {
                        attributes: {
                            class: 'prose prose-sm sm:prose lg:prose-lg xl:prose-xl sm:max-w-none focus:outline-none' + ' ' + this.heightClass
                        }
                    },
                    content: this.content,
                    onCreate({editor}) {
                        _this.updatedAt = Date.now();
                        _this.content = editor.getHTML();
                    },
                    onUpdate({editor}) {
                        _this.updatedAt = Date.now();
                        _this.content = editor.getHTML();
                    },
                    onSelectionUpdate({editor}) {
                        _this.updatedAt = Date.now();
                        _this.content = editor.getHTML();
                    }
                });

                this.$watch('content', () => {
                    this.wordCount = this.wordCountType === 'word'
                        ? editor.storage.characterCount.words()
                        : editor.storage.characterCount.characters();

                    // If the new content matches TipTap's then we just skip.
                    if (this.content === editor.getHTML()) {
                        return;
                    }

                    // Otherwise, it means that a force external to TipTap
                    // is modifying the data on this Alpine component,
                    // which could be Livewire itself.
                    // In this case, we just need to update TipTap's content.
                    editor.commands.setContent(this.content, false);
                })

                window.addEventListener('media-manager:file-selected', (event) => {
                    if (event.detail.id === editorMediaManagerId) {
                        // Get image dimensions.
                        const img = document.createElement('img');

                        img.onload = () => {
                            // Set image
                            this.editor().commands.setImage({
                                    src: event.detail.url,
                                    alt: event.detail.metadata.alt,
                                    title: null,
                                    width: img.width,
                                    height: img.height
                                }
                            );

                            // Then focus the editor so we can emit the outfous event to Livewire
                            // after inserting an image.
                            editor.view.dom.focus();
                        };

                        img.src= event.detail.url;
                    }
                })

                // this.$refs.editorReference.addEventListener('keydown', e => {
                // if (e.key === 'Tab') {
                //     e.preventDefault();
                // }
                // });
            }
        };
    });
});
