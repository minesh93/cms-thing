const ClawsRepeater = {

    install(Vue, options) {
        this.event = new Vue();    

        Vue.prototype.$repeater = {
            clone(type) {
                ClawsRepeater.event.$emit('clone', type);
            },

            remove(type, content) {
                ClawsRepeater.event.$emit('remove',type,content)
            }
        }
    }
};

export default ClawsRepeater;
