const ClawsRepeater = {

    install(Vue, options) {
        this.event = new Vue();    

        Vue.prototype.$repeater = {
            clone(type){
                ClawsRepeater.event.$emit('clone', type);
            },
        }
    }
};

export default ClawsRepeater;
