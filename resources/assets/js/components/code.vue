<template>
    <div class="code-wrap">
        <div class="editor" style="height:274px;">{{code}}</div>
    </div>
</template>

<script>
    import ace from 'brace';
    export default {
        props: ['value'],

        data() {
            return {
                code: 'function code(){ };',
                listeningForFile: false,
                dragging: false,
            }
        },

        beforeMount(){
            // if(this.value !== undefined && this.value !== null){
            //     this.media = this.value;
            // } else {
            //     this.media = null;
            // }

            // ClawsUploader.event.$on('select-media', (mediaObject) => {
            //     if(this.listeningForFile) {
            //         this.media = mediaObject;
            //         this.$emit('input',this.media);
            //         this.listeningForFile = false;
            //     }
            // });
        },

        mounted() {
            console.log(':D');
            console.log(this.$el.querySelector('.editor'));
            ace.edit(this.$el.querySelector('.editor'));
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