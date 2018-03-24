<template>
    <div class="media-item">
        <template v-if="filePath == '' || filePath === undefined || filePath === null">
            <button v-on:click="openUploader" type="button" class="primary full-width">Add Media</button>
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
            }
        },

        beforeMount(){
            ClawsUploader.event.$on('select-media', (mediaObject) => {
                if(this.listeningForFile) {
                    this.filePath = mediaObject.path;
                    this.$emit('input',this.filePath);
                    this.listeningForFile = false;
                }
            });
        },

        methods:{
            openUploader() {
                this.listeningForFile = true;
                this.$uploader.open();
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

.media-item img {
    max-width: 100%;
}
</style>
