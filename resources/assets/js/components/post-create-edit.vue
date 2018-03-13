<template>
    <main>
        <h1 class="title">{{type.createText}}</h1>
        <form class="row" v-on:submit="savePost">
            <div class="col-xs-9">
                <div class="fieldset">
                    <input class="large-field" type="text" placeholder="Name Here" v-model="post.name" v-on:change="generateSlug">
                </div>


                <!-- Get rid of this shit when I actually have components for fancy stuff -->
                <div class="row">
                    <div class="col-xs-6">
                        <div class="fieldset large-field">
                            <label>Meta 1</label>
                            <input class="large-field" type="text" placeholder="Name Here" v-model="post.meta1">
                            <span class="description">Description</span>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-12">
                        <div class="fieldset large-field">
                            <label>Meta 2</label>
                            <v-editor class="large-field" type="text" placeholder="Name Here" v-model="post.meta2"></v-editor>
                            <span class="description">Description</span>
                        </div>
                    </div>
                </div>

                <div class="meta-section" v-if="renderMeta">
                    <slot></slot>
                </div>
            </div>
            
            <div class="col-xs-3">
                <div class="post-sidebar-wrap">
                    <h3>Settings</h3>
                    <div class="post-sidebar">                    
                        <div class="fieldset">
                            <label class="label">URL</label>
                            <input type="text" placeholder="" v-model="post.slug">
                        </div>
                        <div class="post-stats" v-if="post.id">
                            <div class="post-date">Last Updated: {{post.updated_at}}</div>
                            <div class="post-date">Created: {{post.created_at}}</div>
                        </div>

                        <div class="fieldset">
                            <button class="button primary full-width" v-on:click="savePost">Save</button>
                        </div>
                        
                        <div class="fieldset">
                            <button class="button danger full-width" v-on:click="deletePost">Delete</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
        <v-uploader></v-uploader>
    </main>
</template>

<script>
    export default {
        props:['mount-p','mount-t','mount-m'],
        data:function(){
            return {
                renderMeta:false,
                post:{},
                type:{},
            }
        },
        mounted() {
            this.post = this.$options.propsData.mountP;
            this.type = this.$options.propsData.mountT;

            // this.post.meta = this.$options.propsData.mountM;
            this.renderMeta = true;

        },
        methods:{
            savePost(e){
                e.preventDefault();
                let location = `/admin/content/${this.post.type}/add`;
                let newPost = true;
                if(this.post.id != undefined){
                    newPost = false;
                    location = `/admin/content/${this.post.type}/${this.post.id}`;
                }
                axios.post(location,this.post).then((response)=>{
                    this.$parent.$emit('make-notification',{text:'Post Saved!',type:'is-success'});
                    this.post = response.data;
                    if(newPost){
                       window.location = `/admin/content/${this.post.type}/${this.post.id}`; 
                    }
                }).catch((error)=>{
                    this.$parent.$emit('make-notification',{text:'Something Just Broke...',type:'is-danger'});
                });
            },

            deletePost(e){
                e.preventDefault();
                console.log('Preventing Default');
            },

            addImage(){

            },

            generateSlug(e){
                if(this.post.slug != ''){
                    return;
                }
                axios.post('/admin/slug',this.post).then((response)=>{
                    this.post.slug = response.data;
                    console.log("done");
                    console.log(response.data);
                }).catch((error)=>{

                });
            },
        }
    }
</script>
