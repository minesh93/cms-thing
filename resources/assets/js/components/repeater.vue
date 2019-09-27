<template>
    <div class="repeater">
        <div class="repeater-content">
            <slot name="repeater-content" :content="value"></slot>
            <slot></slot> 
        </div>
    </div>
</template>

<script>
import ClawsRepeater from '../plugins/repeater';

export default {
    props: ['value','type'],

    beforeMount() {
        
        if(this.value == undefined){
            this.value = [];
            this.$emit('input',this.value);
        }

        ClawsRepeater.event.$on('clone', (type) => {
            //- Check type before we clone since other repeaters share the same event bus
            if(type == this.type) {

                //- Contains a crappy random ID to track the object only used when deleteing an object
                let content = {
                    claws_repeater_ID: Math.random().toString(32)
                };

                this.value.push(content);
                this.$emit('input',this.value);
            }
        });


        ClawsRepeater.event.$on('remove', (type,content) => {
            if(type == this.type) {
                let index = this.value.findIndex((item) => {
                    return content.claws_repeater_ID === item.claws_repeater_ID
                });

                this.value.splice(index, 1);
            }
        });

    },
    methods: {

    },
}
</script>
<style lang="scss">
.repeater {
    margin-bottom: 1.5rem;
    padding: 1.5rem;
    background: #f3f3f3;

    .remove-button {
        width: 100%;
        display: block;
        margin-top: 1.5rem;
    }
}

</style>
