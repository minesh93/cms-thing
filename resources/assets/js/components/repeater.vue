<template>
    <div class="repeater">
        <div class="repeater-content">
                <slot name="repeater-content" :content="content"></slot>
                <slot></slot> 
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['value'],

        data() {
            return {
                content: [{a:'test'},{a:'temp'}],
            }
        },

        beforeMount(){
            this.$emit('input',this.content);
        },
        methods:{

        },
    }
</script>
