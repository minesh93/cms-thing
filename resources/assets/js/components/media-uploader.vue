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
                        console.log('yay');
                        console.log(response);
                    }).catch((error,err)=>{
                        console.log(error);
                    })

                    // let reader  = new FileReader();
                    // reader.addEventListener("load", () => {

                    //     let background = {
                    //         hex:  '#ffffff',
                    //         hsl:  {h: 255, s: 255, l: 255},
                    //         hsv:  {h: 255, s: 255, v: 255},
                    //         rgba: {r: 255, g: 255, b: 255, a: 1},
                    //         a: 1
                    //     };


                    //     let image = new Image();
                    //     image.src = reader.result;
                    //     image.onload = () => {

                    //         this.workspaceContext.fillStyle = `rgba(${background.rgba.r},${background.rgba.g},${background.rgba.b},${background.rgba.a})`;
                    //         this.workspaceContext.fillRect(0,0,this.width,this.height);
                    //         this.workspaceContext.drawImage(image, 0,0);
                    //         this.frames.push({
                    //             type:'IMAGE',
                    //             id: this.frames.length,
                    //             image:{
                    //                 x:0,
                    //                 y:0,
                    //                 width: image.width,
                    //                 height: image.height,
                    //                 src: image,
                    //             },
                    //             preview: this.workspaceContext.canvas.toDataURL(),
                    //             background: background,
                    //         });

                    //         this.goToFrame(this.frames.length - 1);

                    //     };
                    //     e.target.value = '';
                    // });
                    // reader.readAsDataURL(e.target.files[0]);
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
