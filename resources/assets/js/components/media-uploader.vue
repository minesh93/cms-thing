<template>
    <div class="uploader-wrap" :class="{'active':!hidden}">
        <div class="overlay"></div>
        <div class="uploader">
            <div class="uploader-header">
                <h2>Media</h2>
                <div class="uploader-search">
                    <div class="row">
                        <div class="col-xs-3">
                            <input type="text">
                        </div>
                    </div>
                </div>
            </div>
            <div class="media-wrap">
                <button class="file" v-for="mediaItem in media" v-on:click="selectFile(mediaItem.id)">
                    <div class="img-wrap">
                        <img :src="mediaItem.path">
                    </div>
                    <div class="file-info">
                        <div class="name">{{mediaItem.title}}</div>
                    </div>
                </button>             
            </div>
            <div class="selected-file" v-if="activeFile !== undefined ">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="fieldset">
                            <label>Title</label>
                            <input type="text" v-model="activeFile.title">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="fieldset">
                            <label>Description</label>
                            <textarea type="text" v-model="activeFile.description"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="fieldset">
                            <label>Uploaded on</label>
                            <span class="description">{{activeFile.created_at}}</span>
                        </div>
                    </div>
                </div>

                
                <div class="row">
                    <div class="col-xs-6">
                        <div class="fieldset">
                            <button class="button primary full-width" v-on:click="updateFile">Update</button>
                        </div>
                    </div>
                    
                    <div class="col-xs-6">
                        <div class="fieldset">
                            <button class="button primary full-width" v-on:click="updateFile">Use File</button>
                        </div>
                    </div>

                </div>
             </div>   
            <div class="uploader-footer">
                <button class="button primary large full-width" v-on:click="triggerUpload">Drag Files or Click to Upload</button>
                <input type="file" id="file-upload" class="input-image" v-on:change="readFile">
            </div>
        </div>
    </div>
</template>

<script>

    import ClawsUploader from '../plugins/uploader';

    export default {

        data() {
            return {
                uploading: false,
                hidden: true,
                media: [],
                activeFile: undefined,
            }
        },

        beforeMount(){
            console.log('hook beforeMounted');
            ClawsUploader.event.$on('open-uploader', (options) => {
                this.hidden = false;
                console.log(options);
                console.log(options.a = 100);
            });
        },

        methods:{

            triggerUpload(){
                document.getElementById('file-upload').click();
            },

            updateFile(){
                axios.post(`/admin/update-media/${this.activeFile.id}`,this.activeFile).then(response => console.log(response));
            },

            readFile(e) {
                console.log('upload');
                if(e.target.files[0]){

                    let data = new FormData();
                    data.append('user-file', e.target.files[0]);
                    axios.post('/admin/media', data, {
                        headers: {
                          'Content-Type': 'multipart/form-data'
                        },
                        onUploadProgress: function(progressEvent) {
                            var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                            console.log(percentCompleted);
                        }
                    }).then(response => {
                        this.uploading = false;
                        this.media.push(response.data);
                        this.selectFile(response.data.id);
                    }).catch((error,err)=>{
                        console.log(error);
                    });
                }
            },

            selectFile(fileID) {
                this.activeFile = this.media.find(file => file.id == fileID);
            },

            searchMediaHere(term) {

            },
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

</style>
