<template>
    <main>
        <h1 class="title">{{type.createText}}</h1>
        <div class="row" v-on:submit="savePost">
            <div class="col-xs-9">
                <div class="fieldset">
                    <input class="large-field" type="text" placeholder="Name Here" v-model="post.name" v-on:change="generateSlug">
                </div>

                <div class="meta-section">
                    <slot :post="post"></slot>
                </div>
            </div>
            
            <div class="col-xs-3">
                <div class="post-sidebar-wrap">
                    <h3>Settings</h3>
                    <div class="post-sidebar">
                        <template v-if="editingURL">
                             <div class="post-url">
                                <div class="url-prefix">
                                    <span>{{`${location.host}/`}}</span>
                                    <input type="text" placeholder="" v-model="post.slug">
                                </div>
                                <button class="primary" v-on:click="editingURL = false">Done</button>
                            </div>
                        </template>
                        <template v-else>
                            <div class="post-url">
                                <a :href="`//${location.host}/${post.slug}`" target="_blank">{{`${location.host}/${post.slug}`}}</a>
                                <button class="primary" v-on:click="editingURL = true;">Edit</button>
                            </div>
                        </template>

                        <!-- <div class="fieldset" v-if="mountT.useCustomTemplates">
                            <label class="label">Template</label>
                            <select v-model="post.template" return="file" track-by="file" label="name" placeholder="Template" :options="mountT.renderTemplates" :searchable="false" :show-labels="false"></v-select>
                        </div> -->

                        <div class="post-stats" v-if="post.id">
                            <div class="post-dates">
                                <div class="post-date">
                                    <div class="date-title">
                                        <i class="fas fa-calendar"></i>
                                        Updated
                                    </div>
                                    <div>{{post.updated_at}}</div>
                                </div>
                                <div class="post-date">
                                    <div class="date-title">
                                        <i class="fas fa-calendar"></i>
                                        Created
                                    </div>
                                    <div>{{post.created_at}}</div>
                                </div>
                            </div>
                        </div>

                        <div class="post-controls button-set">
                            <button class="button primary" v-on:click="savePost">Save</button>
                            <button class="button danger link" v-on:click="deletingPost = true">Delete</button>
                        </div>

                        <div class="post-controls-footer">
                            <div v-if="deletingPost" class="action danger">
                                <div class="message">Really Delete this? </div>
                                <div class="button-set">
                                    <button class="button danger link" v-on:click="deletePost">Yes, delete it</button>
                                    <button class="button primary link" v-on:click="deletingPost = false">No, keep it</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </main>
</template>

<script>
    export default {
        props:['mount-p','mount-t','mount-m'],
        data:function(){
            return {
                post:{
                    slug:'',
                    content: {},
                },
                type:{},
                editingURL: false,
                deletingPost: false
            }
        },
        computed: {
            location() {
                return window.location;
            }
        },

        beforeMount(){
            console.log('before Mount');
            this.post = this.$options.propsData.mountP;
            this.post.content = this.post.mappedContent;
            this.type = this.$options.propsData.mountT;
        },

        mounted() {
            console.log('mounted');

            if(this.post.slug == '' || typeof this.post.slug == 'undefined') {
                this.editingURL = true;
            }

        },
        methods:{
            savePost(e){
                
                e.preventDefault();

                let location = `/${admin}/content/${this.post.type}/add`;
                let newPost = true;

                this.$notification.clear();

                if(this.post.id != undefined){
                    newPost = false;
                    location = `/${admin}/content/${this.post.type}/${this.post.id}`;
                }
                axios.post(location,this.post).then((response)=>{
                    this.$notification.add({content:'Saved!',type:'success'});
                    this.post = response.data;
                    this.post.content = response.data.mappedContent;
                    if(newPost){
                       window.location = `/${admin}/content/${this.post.type}/${this.post.id}`; 
                    }
                }).catch((error)=>{
                    this.$notification.add({content:'Something Just Broke...',type:'danger'});
                });
            },

            deletePost(e) {
                e.preventDefault();
            },

            logAction(e) {
                console.log('aaaa');
            },

            generateSlug(e) {
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
