<template>
    <main>
        <h1 class="title">{{mountS.name}}</h1>
        <form class="row" v-on:submit="savePost">
            <div class="col-xs-12">
                <div class="meta-section">
                    <slot :settings="settings"></slot>
                </div>
            </div>
            <div class="col-xs-3">
                <button class="large primary" type="submitr">Save</button>
            </div>
        </form>
        
    </main>
</template>

<script>
    export default {
        props:['mount-s'],
        data:function(){
            return {
                settings:{},
            }
        },

        methods:{
            savePost(e){
                e.preventDefault();
                const location = `/admin/settings/${this.mountS.key}`;

                axios.post(location,this.settings).then((response)=>{
                    this.$parent.$emit('make-notification',{text:'Post Saved!',type:'is-success'});
                    // this.post = response.data;
                    
                }).catch((error)=>{
                    this.$parent.$emit('make-notification',{text:'Something Just Broke...',settings:'is-danger'});
                });
            },

        }
    }
</script>
