const ClawsUploader = {

    install(Vue, options) {
        this.event = new Vue();    

        Vue.prototype.$uploader = {
            open(){
                ClawsUploader.event.$emit('open-uploader');
            },

            uploadFiles(files){
                ClawsUploader.event.$emit(files);
            }
        }
    }
};

export default ClawsUploader;
