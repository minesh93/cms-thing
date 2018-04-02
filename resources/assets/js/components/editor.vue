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



