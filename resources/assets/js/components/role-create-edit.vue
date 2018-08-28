<template>
    <main>
        <form class="role-form" v-on:submit="savePost">
            <div class="fieldset">
                <h1 class="title">Create A New Role</h1>
                <input class="large-field" type="text" placeholder="Name Here" v-model="role.name">
            </div>

            <div class="role-wrapper">
                <div v-for="permission in permissions" class="role-collection">
                    <h2>{{permission.name}}</h2>
                    <div class="permission-selector-wrap">
                        <div class="description">{{permission.description}}</div>
                        <div class="permission-selector row">
                            <div v-for="permissionItem in permission.permissions" class="col-xs-6">
                                <div class="checkbox-wrap">
                                <label :for="permissionItem.key">
                                    <input type="checkbox" :value="permissionItem.key" v-model="role.permissions" :id="permissionItem.key">
                                        <div>{{permissionItem.name}}</div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row center-xs">
                <div class="col-xs-3">
                    <button type="submit" class="button primary full-width large"><i class="fas fa-save"></i> Save Role</button>
                </div>
            </div>
        </form>
    </main>
</template>

<script>
    export default {
        props:['mount-r','mount-p'],
        data:function(){
            return {
                renderMeta:false,
                role:{},
                permissions:{},
            }
        },
        mounted() {
            this.role = this.$options.propsData.mountR;
            this.permissions = this.$options.propsData.mountP;
            console.log(this.role);
        },
        methods:{
            savePost(e){
                e.preventDefault();
                let location = `/${admin}/roles/add`;
                let newRole = true;
                if(this.role.id != undefined){
                    newRole = false;
                    location = `/${admin}/roles/${this.role.id}`;
                }
                axios.post(location,this.role).then((response)=>{
                    this.$parent.$emit('make-notification',{text:'Role Saved!',type:'is-success'});
                    this.role = response.data;
                    if(newRole){
                       window.location = `/${admin}/roles/${this.role.id}`; 
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
        }
    }
</script>
