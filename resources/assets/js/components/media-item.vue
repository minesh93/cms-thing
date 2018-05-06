<template>
    <div class="media-item">
        <template v-if="media === null || media === undefined">
            <div class="drag-zone"  :class="{'dragging':dragging}" v-on:dragenter="dragging = true" v-on:dragleave="dragging = false">
                <div>Drop Files Here</div>
                <div>Or</div> 
                <div>Click To Upload</div> 
                <input type="file" v-on:change="upload">
            </div>
            <button v-on:click="openUploader" type="button" class="primary full-width">Choose Existing File</button>
        </template>
        <template v-else>
            <div class="file">
                <img :src="media.path">
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
                media: {},
                listeningForFile: false,
                dragging: false,
            }
        },

        beforeMount(){
            if(this.value !== undefined && this.value !== null){
                this.media = this.value;
            } else {
                this.media = null;
            }

            ClawsUploader.event.$on('select-media', (mediaObject) => {
                if(this.listeningForFile) {
                    this.media = mediaObject;
                    this.$emit('input',this.media);
                    this.listeningForFile = false;
                }
            });
        },

        methods:{
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
                this.media = null;
                this.$emit('input',this.media);
            }
        },
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
    margin-bottom: 15px;
    cursor: pointer;
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
