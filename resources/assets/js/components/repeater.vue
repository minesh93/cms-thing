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
        props: ['value'],

        data() {
        },

        beforeMount(){
            ClawsRepeater.event.$on('clone', (tag) => {
                this.value.push({});
                this.$emit('input',this.value);
            });
        },
        methods: {

        },
    }
</script>
<style lang="scss">
.repeater {
    margin-bottom: 15px;
}
</style>
