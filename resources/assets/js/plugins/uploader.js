const ClawsUploader = {
    install(Vue, options) {
    // 1. add global method or property
        Vue.myGlobalMethod = () => {
        // something logic ...
        }

        // 2. add a global asset
        Vue.directive('my-directive', {
            bind (el, binding, vnode, oldVnode) {
                
            }
        });

        // 3. inject some component options
        Vue.mixin({
            created: function () {
                console.log('component'); 
            }
        });

        // 4. add an instance method
        Vue.prototype.$openUploader = (methodOptions) => {
        
        }
    }
};

export default ClawsUploader;
