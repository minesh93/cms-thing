<template>
  <div class="quill-editor">
    <div class="controls">
        <label>{{ label }}</label>
        <button @click="useEditor()">Editor</button>
        <button @click="useHTML()">HTML</button>
    </div>
    <div class="code-wrap" v-show="!usingEditor">
        <div class="editor" style="height:274px;"></div>
    </div>
    <div class="editor-wrap" v-show="usingEditor">
        <slot name="toolbar"></slot>
        <div ref="editor"></div>
    </div>
  </div>
</template>
<script>
import { quillEditor } from 'vue-quill-editor'
import ace from 'brace';
require('../ace-theme/claws');

import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'
import ClawsUploader from '../plugins/uploader';

export default {
    mixins: [quillEditor],

    data () {
        return {
            internalValue: {},
            listeningForFile: false,
            usingEditor: true,
        }
    },

    computed:{
        code() {
            return {
                code: this.value,
            }
        }
    },

    props: {
        return: {
            type: String,
            default: ''
        },
        label: {
            type: String,
            default: ''
        },
    },

    beforeMount() {
        ClawsUploader.event.$on('select-media', (mediaObject) => {
            if(this.listeningForFile) {
                const range =  this.quill.getSelection();
                this.quill.insertEmbed(range.index, 'image', mediaObject.path);
                this.listeningForFile = false;
            }
        });
    },

    mounted() {
        this.quill.getModule('toolbar').handlers.image = this.handleUpload;

        this.editor = ace.edit(this.$el.querySelector('.editor'));
        this.editor.setTheme('ace/theme/claws');

        this.editor.session.setMode(`ace/mode/html`);
        this.editor.session.setUseWorker(false);
        this.editor.setPrintMarginColumn(-1);
        this.editor.session.setValue(this.value);

    },

    methods: {

        useEditor() {
            this.usingEditor = true;
            this.quill.clipboard.dangerouslyPasteHTML(this.editor.getValue());
        },

        useHTML() {
            this.usingEditor = false;
            this.editor.setValue(this.value);
        },

        handleUpload() {
            this.listeningForFile = true;
            this.$uploader.open();
        }
    }   
}
</script>
<style type="text/css">	
    .quill-editor .controls {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .quill-editor .controls label {
        display: flex;
        margin-right: auto;
    }

    .quill-editor .controls button {
        background: #ffffff;
        color: #000000;
        font-weight: 600;
        border: 1px solid #dbebf9;
        border-bottom: none;
        margin-right: -1px;
        border-radius: 0;
    }

    .quill-editor .controls button:last-child {
        margin-right: 0px;
    }

    .quill-editor .controls button:focus {
        outline: initial;
    }    

    .quill-editor .ql-toolbar {
        background: #ffffff
    }
    .quill-editor .ql-container {
        background: #ffffff;
    }

    .ql-toolbar.ql-snow {
        border: 1px solid #dbebf9;
    }
    .ql-toolbar.ql-snow + .ql-container.ql-snow {
        border: 1px solid #dbebf9;
        border-top: none;
    }

    .ql-container {
        height: 300px;
    }
</style>



