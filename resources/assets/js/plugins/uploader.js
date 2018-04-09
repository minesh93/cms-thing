const ClawsUploader = {

    install(Vue, options) {
        this.event = new Vue();    

        Vue.prototype.$uploader = {
            open(){
                ClawsUploader.event.$emit('open-uploader');
            },
            
            upload(files){
                ClawsUploader.event.$emit('upload', files);
            }
        }
    }
};

export default ClawsUploader;
