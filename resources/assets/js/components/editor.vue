<template>
  <div class="quill-editor">
    <div class="controls">
        <button v-on:click="useEditor()">Editor</button>
        <button v-on:click="useHTML()">HTML</button>
    </div>
    <slot name="toolbar"></slot>
    <div ref="editor"></div>
  </div>
</template>
<script>
import { quillEditor } from 'vue-quill-editor'

// require styles
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'
import ClawsUploader from '../plugins/uploader';

export default {
    mixins: [quillEditor],

    data () {
        return {
            internalValue: {},
            listeningForFile: false
        }
    },

    props: {
        return: {
        type: String,
            default: ''
        }
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
    },
    methods: {
        handleUpload(){
            this.listeningForFile = true;
            this.$uploader.open();
        }
    }   
}
</script>
<style type="text/css">	
    .quill-editor {
        
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



