<template>
    <div class="uploader-wrap">
        <div class="overlay"></div>
        <div class="uploader">
            <div class="uploader-header">
                <h2>Media</h2>
            </div>
            <div class="media-wrap">
                <button class="file">
                    <div class="img-wrap">
                        <img src="https://placeimg.com/640/480/tech/sepia">
                    </div>
                    <div class="file-info">
                        <div class="name">Important Image Name</div>
                    </div>
                </button>
                <button class="file">
                    <div class="img-wrap">
                        <img src="https://placeimg.com/1920/300/tech/sepia">
                    </div>
                    <div class="file-info">
                        <div class="name">Important Image Name</div>
                    </div>
                </button>
                <button class="file">
                    <div class="img-wrap">
                        <img src="https://placeimg.com/1920/1080/tech/sepia">
                    </div>
                    <div class="file-info">
                        <div class="name">Important Image Name</div>
                    </div>
                </button>
                <button class="file">
                    <div class="img-wrap">
                        <img src="https://placeimg.com/500/500/tech/sepia">
                    </div>
                    <div class="file-info">
                        <div class="name">Important Image Name</div>
                    </div>
                </button>
                <button class="file">
                    <div class="img-wrap">
                        <img src="https://placeimg.com/640/480/tech/sepia">
                    </div>
                    <div class="file-info">
                        <div class="name">Important Image Name</div>
                    </div>
                </button>

                <button class="file">
                    <div class="img-wrap">
                        <img src="https://placeimg.com/640/480/tech/sepia">
                    </div>
                    <div class="file-info">
                        <div class="name">Important Image Name</div>
                    </div>
                </button>
                <button class="file">
                    <div class="img-wrap">
                        <img src="https://placeimg.com/1920/300/tech/sepia">
                    </div>
                    <div class="file-info">
                        <div class="name">Important Image Name</div>
                    </div>
                </button>
                <button class="file">
                    <div class="img-wrap">
                        <img src="https://placeimg.com/1920/1080/tech/sepia">
                    </div>
                    <div class="file-info">
                        <div class="name">Important Image Name</div>
                    </div>
                </button>
                <button class="file">
                    <div class="img-wrap">
                        <img src="https://placeimg.com/500/500/tech/sepia">
                    </div>
                    <div class="file-info">
                        <div class="name">Important Image Name</div>
                    </div>
                </button>
                <button class="file">
                    <div class="img-wrap">
                        <img src="https://placeimg.com/640/480/tech/sepia">
                    </div>
                    <div class="file-info">
                        <div class="name">Important Image Name</div>
                    </div>
                </button>
                
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
                media: []
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
                        console.log('uploaded');
                        console.log(response);
                    }).catch((error,err)=>{
                        console.log(error);
                    });
                }
            },

            uploadMediaHere() {

            },

            searchMediaHere(term) {

            },
        },


        mounted() {
            axios.get('/admin/media').then((response)=>{
                this.media = response;
            }).catch((error)=>{
                console.log(error);
            });
        }
    }
</script>
<style type="text/scss">

</style>
