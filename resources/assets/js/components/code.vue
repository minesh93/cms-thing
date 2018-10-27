<template>
    <div class="code-wrap">
        <div class="editor" style="height:274px;"></div>
        <div class="select-wrap">
            <select class="language-selector" v-model="language">
                <option value="javascript">Javascript</option>
                <option value="php">PHP</option>
                <option value="html">HTML</option>
                <option value="css">CSS</option>
                <option value="sass">SASS</option>
                <option value="less">LESS</option>
                <option value="typescript">Typescript</option>
                <option value="ruby">Ruby</option>
                <option value="vbscript">VB Script</option>
                <option value="csharp">C#</option>
                <option value="c_cpp">C++</option>
            </select>
        </div>
    </div>
</template>

<script>
    import ace from 'brace';
    require('../ace-theme/claws');

    export default {
        props: ['value'],

        data() {
            return {
                language: 'javascript',
                editor: null,
            }
        },

        mounted() {
            let temp = this.value;

            if(typeof this.value != "object") {
                temp = {
                    code: '',
                    language: this.language
                }
            } else {
                temp.code = this.value.code;
                temp.language = this.value.language
            }

            this.language = temp.language;

            this.editor = ace.edit(this.$el.querySelector('.editor'));
            this.editor.setTheme('ace/theme/claws');

            this.editor.session.setMode(`ace/mode/${this.language}`);
            this.editor.session.setUseWorker(false);
            this.editor.setPrintMarginColumn(-1);
            this.editor.session.setValue(temp.code);

            this.editor.on('change',() => {
                this.$emit('input',{
                    code: this.editor.getValue(),
                    language: this.language
                });
            });
        },

        watch:{
            language(newLanguage) {
                this.$emit('input',{
                    code: this.editor.getValue(),
                    language: newLanguage
                });
            }
        },

        methods:{
            openUploader() {
                this.listeningForFile = true;
                this.$uploader.open();
            },

            upload(e) {
                this.dragging = false;
                this.openUploader();
                this.$uploader.upload(e.target.files);
            },

            removeFile() {
                this.media = null;
                this.$emit('input',this.media);
            }
        },
    }
</script>