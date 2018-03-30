<template>
    <div class="media-item">
        <template v-if="filePath == '' || filePath === undefined || filePath === null">
            <div class="drag-zone"  :class="{'dragging':dragging}" v-on:dragenter="dragging = true" v-on:dragleave="dragging = false">
                <div>Drop Files Here</div>
                <div>Or</div> 
                <div>Click To Upload</div> 
                <input type="file" v-on:change="upload">
            </div>
        </template>
        <template v-else>
            <div class="file">
                <img :src="filePath">
            </div>
            <div>
                <div class="row">
                    <div class="col-xs-6">
                        <button v-on:click="openUploader" type="button" class="primary full-width">Change</button>
                    </div>
                    
                    <div class="col-xs-6">
                        <button v-on:click="removeFile" type="button" class="danger full-width">Remove</button>
                    </div>
                </div>            
            </div>
        </template>
    </div>
</template>

<script>
    import ClawsUploader from '../plugins/uploader';

    export default {
        props: ['value'],

        data() {
            return {
                filePath: this.value || this.value === 0,
                listeningForFile: false,
                dragging: false,
            }
        },

        beforeMount(){
            ClawsUploader.event.$on('select-media', (mediaObject) => {
                if(this.listeningForFile) {
                    console.log('listening for file');
                    this.filePath = mediaObject.path;
                    this.$emit('input',this.filePath);
                    this.listeningForFile = false;
                }
            });
        },

        methods:{
            handleDragOver(){
                
            },

            openUploader() {
                this.listeningForFile = true;
                this.$uploader.open();
            },

            upload(e) {
                this.dragging = false;
                this.openUploader();
                this.$uploader.upload(e.target.files);
            },

            removeFile() {
                this.filePath = '';
                this.$emit('input',this.filePath); 
            }
        },
        mounted() {
            axios.get('/admin/media').then((response)=>{
                this.media = response.data;
            }).catch((error)=>{
                console.log(error);
            });
        }
    }
</script>
<style type="text/scss">
.media-item {
    width: 100%;
    background: #ececec;
    padding: 15px;
    text-align: center;
}

.media-item .file {
    margin-bottom: 15px;
}

.media-item .drag-zone{
    border: 2px dashed rgba(0, 0, 0, 0.3);
    width: 100%;
    height: 240px;
    position: relative;
    display: flex;
    flex-flow: column;
    align-items: center;
    justify-content: center;
    justify-content: center;
    font-size: 13px;
    text-transform: uppercase;
    transition: all 0.2 ease;
    transform: scale(1);
}

.media-item .drag-zone.dragging {
    background: #dbebf9;
}

.media-item input[type="file"]{
    position: absolute;
    width: 100%;
    height: 100%;
    display: block;
    opacity: 0;
    z-index: 1;
}

.media-item img {
    max-width: 100%;
}
</style>
