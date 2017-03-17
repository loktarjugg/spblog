<template lang="html">
    <el-form :model="form" :rules="rules" ref="form" label-width="100px" class="demo-ruleForm">
        <el-form-item label="文章名称" prop="title" :span="5">
            <el-input v-model="form.title"></el-input>
        </el-form-item>

        <el-form-item label="封面" prop="cover">
            <el-upload
                    class="upload-demo"
                    drag
                    :on-success="handleSuccess"
                    :on-error="handleError"
                    :on-remove="handleRemove"
                    :file-list="form.cover"
                    action="/upload"
                    mutiple>
                <i class="el-icon-upload"></i>
                <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
            </el-upload>
            <input hidden v-model="form.cover">
        </el-form-item>

        <el-form-item label="标签" prop="tags">
            <multiselect
                    tag-placeholder="创建新的标签"
                    placeholder="搜索或添加标签"
                    label="name"
                    track-by="name"
                    :options="tags"
                    :value="tag"
                    :multiple="true"
                    :taggable="true"
                    :max="3"
                    @input="putTag"></multiselect>
            <input hidden v-model="form.tags">
        </el-form-item>

        <el-form-item label="文章内容" prop="body" id="textarea_body">
            <textarea id="textarea"></textarea>
            <input hidden v-model="form.body">
        </el-form-item>

        <el-form-item>
            <el-button type="primary" @click="submitForm('form')">立即创建</el-button>
            <el-button @click="resetForm('form')">重置</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    import {mapState, mapActions} from 'vuex'
    import Multiselect from 'vue-multiselect'
    import SimpleMDE from 'simplemde';
    import '../plugs/inline_attachment/inline-attachment.min';
    import '../plugs/inline_attachment/codemirror-4.inline-attachment';

    export default {
        components: { Multiselect },
        data() {
            return {
                form:{
                    title: '',
                    cover: [
                        {
                            url:'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'
                        }
                    ],
                    tags :'',
                    body:''
                },
                rules: {
                    title: [
                        { required: true, message: '请输入文章名称', trigger: 'blur' },
                        { min: 5, max: 200, message: '长度在 5 到 200 个字符', trigger: 'blur' }
                    ],
                    cover :[
                        { required: true,message:'必须上传一张封面', trigger: 'blur' }
                    ],
                    tags : [
                        {required:true ,message:'必须选择一个标签' ,trigger:'blur'}
                    ],
                    body : [
                        {required:true ,message:'内容不能为空' ,trigger:'blur'},
                        { min: 100 , message: '最少100个字', trigger: 'blur' }
                    ],
                }
                };
        },
        props: {
            slug:{
                type:String,
                default:''
            },
            actions:{
                type:Object,
                default:function () {
                    return {
                        method:'post',
                        url:'/articles'
                    }
                }
            }
        },
        created(){
            this.fetchData();
        },
        computed:{
            ...mapState([
            'tags',
            'tag',
            'article'
            ])
        },
        mounted() {
            this.initialize();
            console.log(this.article)
        },
        methods: {
            fetchData(){
                this.$store.dispatch('getTags');
                if (this.slug.length > 1){
                    this.$store.dispatch('getArticle' , this.slug);
                }

            },
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        alert('submit!');
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },
            handleSuccess(file, fileList) {
                this.form.cover = file.result.savePath;
            },
            handleError(file) {
                console.log(file);
            },
            handleRemove(file){
                this.form.cover = '';
            },
            ...mapActions(['putTag']),
            initialize() {
                let configs = {};
                configs.element = document.getElementById("textarea");
                configs.initialValue = configs.initialValue || this.form.body;
                configs.lineWrapping = false;
                configs.parsingConfig = {
                    allowAtxHeaderWithoutSpace: true,
                        strikethrough: false,
                        underscoresBreakWords: true,
                };
                configs.spellChecker=false;

                // 实例化编辑器
                this.simplemde = new SimpleMDE(configs);

                // 判断是否引入样式文件
                require('simplemde/dist/simplemde.min.css');

                // 绑定输入事件
                this.simplemde.codemirror.on('change', () => {
                    this.form.body = this.simplemde.value();
                });

                inlineAttachment.editors.codemirror4.attach(this.simplemde.codemirror, {
                    uploadUrl:'/attachment',
                    uploadFieldName:'file',
                });
            },
            addPreviewClass(className) {
                const wrapper = this.simplemde.codemirror.getWrapperElement();
                const preview = document.createElement('div');
                wrapper.nextSibling.className += ` ${className}`;
                preview.className = `editor-preview ${className}`;
                wrapper.appendChild(preview);
            },

        }
    }
</script>

<style lang="scss">
    .is-error{
        .el-upload-dragger ,.multiselect__tags,.editor-toolbar , .cm-s-paper{
            border-color:red;
        }
    }
    #textarea_body{
        .el-form-item__error{
            top:90% !important;
        }
    }
</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
