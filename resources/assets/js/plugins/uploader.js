const ClawsUploader = {

    install(Vue, options) {
        this.event = new Vue();    

        Vue.prototype.$uploader = {
            open(){
                ClawsUploader.event.$emit('open-uploader');
            }
        }
    }
};

export default ClawsUploader;
