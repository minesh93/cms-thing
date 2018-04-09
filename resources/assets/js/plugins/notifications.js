const ClawsNotifications = {

    install(Vue, options) {
        this.event = new Vue();    

        Vue.prototype.$notification = {
            add(notification){
                ClawsNotifications.event.$emit('add', notification);
            },

            clear(){
                ClawsNotifications.event.$emit('clear');
            }
        }
    }
};

export default ClawsNotifications;
