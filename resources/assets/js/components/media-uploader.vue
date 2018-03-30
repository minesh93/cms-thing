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
                <button class="close" v-on:click="closeUploader">
                    &times;
                </button>
            </div>
            <div class="uploader-content">
                <div class="media-container">
                    <!-- Uploading Files here -->
                    <div class="media-wrap uploaded-files" v-if="uploading">
                        <h3>Uploading Files</h3>
                        <button class="file uploading" v-for="mediaItem in uploadingMedia">
                            <div class="progress-wrap">
                                <div class="progress" v-bind:style="{ width: `${mediaItem.progress}%`}"></div>
                            </div>
                        </button>
                    </div>
                    <!-- UploadED Files here -->
                    <div class="media-wrap">
                        <button class="file" v-for="mediaItem in media" v-on:click="selectFile(mediaItem.id)">
                            <div class="img-wrap">
                                <template v-if="['image/png','image/jpg','image/jpeg'].includes(mediaItem.mime)">
                                    <img :src="mediaItem.path">
                                </template>
                                <template v-else>
                                    <div class="file-placeholder"></div>
                                </template>
                            </div>
                            <div class="file-info">
                                <div class="name">{{mediaItem.title}}</div>
                            </div>
                        </button>
                    </div>
                </div>
                <div class="selected-file">
                    <template v-if="activeFile">
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
                                    <button class="button primary full-width" v-on:click="useFile">Use File</button>
                                </div>
                            </div>
                        </div>

                    </template>
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
                uploadingMedia: [],
                media: [],
                currentMediaObject:{
                    path: ''
                },
                options: {
                    
                },
                activeFile: null,
            }
        },

        beforeMount(){
            ClawsUploader.event.$on('open-uploader', (options) => {
                this.hidden = false;
                this.options = options;
            });

            ClawsUploader.event.$on('upload', (files) => {
                _.each(files,(file) => {
                    this.uploadFile(file);
                });
            });
        },

        methods:{

            triggerUpload(){
                document.getElementById('file-upload').click();
            },

            updateFile(){
                axios.post(`/admin/update-media/${this.activeFile.id}`,this.activeFile).then(response => console.log(response));
            },

            useFile(){
                ClawsUploader.event.$emit('select-media',this.activeFile);
                this.hidden = true;
            },

            readFile(e) {
                if(e.target.files[0]) {
                    this.uploadFile(e.target.files[0]);
                }
            },

            uploadFile(file) {
                let id = Math.random().toString(32);
                
                let data = new FormData();
                data.append('user-file', file);

                this.uploading = true;
                this.uploadingMedia.push({
                    id: id,
                    progress: 0,
                });

                axios.post('/admin/media', data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },

                    onUploadProgress: (progressEvent) => {
                        let percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        this.uploadingMedia.find(file => file.id === id).progress = percentCompleted;
                    }
                }).then(response => {
                    this.uploadingMedia = this.uploadingMedia.filter(file =>  file.id !== id ); 

                    if(this.uploadingMedia.length == 0) {
                        this.uploading = false;
                    }

                    this.media.push(response.data);
                    console.log(response.data);
                    this.selectFile(response.data.id);

                }).catch((error,err)=>{
                    console.log(error);
                });

            },

            selectFile(fileID) {
                this.activeFile = this.media.find(file => file.id == fileID);
            },

            closeUploader() {
                this.hidden = true;
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
button.close{
    position: absolute;
    top: 5px;
    right: 0;
    color: #333333;
    background: none;
    font-size: 20px;
}
</style>
