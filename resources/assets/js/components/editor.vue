<script>
import { quillEditor } from 'vue-quill-editor'

// require styles
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'


export default {
  mixins: [quillEditor],

  data () {
    return {
      internalValue: {}
    }
  },

  props: {
    return: {
      type: String,
      default: ''
    }
  },

  mounted(){
  	//- Quill should be here
  	this.quill.getModule('toolbar').handlers.image = this.handleUpload;
  },
  methods: {
  	handleUpload(){
      console.log(this);
      this.$openUploader(this.internalValue);
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

</style>



