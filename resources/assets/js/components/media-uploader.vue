<template>
    <div class="uploader-wrap">
        <div class="overlay"></div>
        <div class="uploader">
            <div class="uploader-header">
                <h2>Media</h2>
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
                <div class="selected-file" v-if="activeFile !== undefined ">
                    {{activeFile.name}}
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
    export default {

        data() {
            return {
                uploading: false,
                hidden: true,
                media: [],
                activeFile: undefined,
            }
        },

        methods:{

            triggerUpload(){
                document.getElementById('file-upload').click();
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
                        this.media.push(response.data);
                        this.selectFile(response.data.id);
                    }).catch((error,err)=>{
                        console.log(error);
                    });
                }
            },

            uploadMediaHere() {

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
