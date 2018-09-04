<template>
    <div class="media-item">

    </div>
</template>

<script>
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
            this.$emit('input',[{a:'test'},{a:'temp'}]);
        },

        methods:{
            // removeFile() {
            //     this.media = null;
            //     this.$emit('input',this.media);
            // }
        },
    }
</script>
