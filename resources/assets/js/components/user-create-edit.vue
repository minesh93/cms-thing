<template>
    <main>
        <h1 class="title">Create New User</h1>
        <form class="row">
            <div class="col-xs-9">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="fieldset">
                            <input type="text" class="large-field" placeholder="Username" v-model="user.username">
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="fieldset">
                            <input type="text" class="large-field" placeholder="First Name" v-model="user.first_name">
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="fieldset large">
                            <input type="text" class="large-field" placeholder="Last Name" v-model="user.last_name">
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="fieldset">
                            <input type="text" class="large-field" placeholder="E-Mail Address" v-model="user.email">
                        </div>
                    </div>


                    <div class="col-xs-12">
                        <div class="fieldset">
                            <v-select class="large-field" v-model="user.role_id" return="id" track-by="id" label="name" placeholder="Role" :options="roles" :searchable="false" :show-labels="false"></v-select>
                        </div>
                    </div>


                    <div class="col-xs-12">
                        <div class="fieldset">
                            <input type="password" class="large-field" placeholder="New Password" v-model="user.password">
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="fieldset">
                            <input type="password" class="large-field" placeholder="Confirm Password" v-model="user.confirm_password">
                        </div>
                    </div>

                    <div class="col-xs-12">
                    <div class="row" v-if="user.id">
                        <div class="col-xs-6">
                            <button class="button primary full-width large" v-on:click="saveUser">Save</button>
                        </div>
                        <div class="col-xs-6">
                            <button class="button danger full-width large" v-on:click="deletePost">Delete</button>
                        </div>
                    </div>

                    <div class="row" v-else>
                        <div class="col-xs-12">
                            <button class="button primary full-width large" v-on:click="saveUser">Save</button>
                        </div>
                    </div>
                    </div>

                </div>

                <div class="meta-section" v-if="renderMeta">
                    <slot></slot>
                </div>
            </div>
            
            <div class="col-xs-3">

                
                <div class="post-sidebar-wrap">
                    <h3>Stats</h3>
                    <div class="post-sidebar">                    
                        <div class="post-stats" v-if="user.id">
                            <div class="post-date">Last Updated: {{user.updated_at}}</div>
                            <div class="post-date">Created: {{user.created_at}}</div>
                        </div>



                              
                    </div>
                </div>
            </div>
        </form>
    </main>
</template>

<script>
    export default {
        props:['mount-u','mount-r'],
        data:function(){
            return {
                renderMeta:false,
                user:{
                    username: '',
                    first_name: '',
                    last_name: '',
                    last_name: '',
                    role_id:0,
                },
                roles:[],
            }
        },
        mounted() {

            this.user = {...this.user,...this.$options.propsData.mountU};
            this.roles = this.$options.propsData.mountR;
            // this.user.meta = this.$options.propsData.mountM;
            this.renderMeta = true;
            console.log(this);

        },
        methods:{
            saveUser(e){
                e.preventDefault();

                let location = `/admin/users/add`;
                let newPost = true;

                if(this.user.id != undefined){
                    newPost = false;
                    location = `/admin/users/${this.user.id}`;
                }

                console.log(this.user);

                axios.post(location,this.user).then((response)=>{
                    this.$parent.$emit('make-notification',{text:'Post Saved!',type:'is-success'});
                    this.user = response.data;
                    if(newPost){
                       window.location = `/admin/users/${this.user.id}`; 
                    }
                }).catch((error)=>{
                    this.$parent.$emit('make-notification',{text:'Something Just Broke...',type:'is-danger'});
                });
            },



            deletePost(e){
                e.preventDefault();
                console.log('Preventing Default');
            },

            generateSlug(e){
                if(this.user.slug != ''){
                    return;
                }
                axios.post('/admin/slug',this.user).then((response)=>{
                    this.user.slug = response.data;
                    console.log("done");
                    console.log(response.data);
                }).catch((error)=>{

                });
            },
        }
    }
</script>
