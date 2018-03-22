<template>
    <div class="media-item">
        <img :src="mediaObject.path">
        <button v-on:click="openUploader" type="button" class="primary full-width">Add Media</button>
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
                mediaObject: {
                    path:''
                },
                activeFile: undefined,
            }
        },

        beforeMount(){
            ClawsUploader.event.$on('select-media', (mediaObject) => {
                this.mediaObject = mediaObject;
            });
        },

        created(){
            console.log(this);
        },

        methods:{
            openUploader() {
                this.$uploader.open();
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
.media-item {
    width: 100%;
    background: #ececec;
    padding: 15px;
    text-align: center;
}

.media-item img {
    max-width: 100%;
}
</style>
