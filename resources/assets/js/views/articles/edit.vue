<template lang="html">
    <div id="content">
        <h3>编辑文章 / 作品</h3>
        <div id="form">
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
                            action="/api/upload"
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
                            @tag="putTag"
                            @select="handleTagSelect"
                            @remove="handleTagRemove"></multiselect>
                    <input hidden v-model="form.tags">
                </el-form-item>

                <el-form-item label="文章内容" prop="body" id="textarea_body">
                    <textarea id="textarea"></textarea>
                    <input hidden v-model="form.body">
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" @click="submitForm('form')">立即创建</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>

<script>
    import {mapState, mapActions} from 'vuex'
    import Multiselect from 'vue-multiselect'
    import SimpleMDE from 'simplemde';
    import { errorMessage } from '../errors/errorMessage'
    import '../../plugs/inline_attachment/inline-attachment.min';
    import '../../plugs/inline_attachment/codemirror-4.inline-attachment';

    export default {
        components: { Multiselect },
        data() {
            return {
                form:{
                    title: '',
                    cover: '',
                    tags :[],
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
                        {required:true ,message:'必须选择一个标签'}
                    ],
                    body : [
                        {required:true ,message:'内容不能为空' ,trigger:'blur'},
                        { min: 1 , message: '最少100个字', trigger: 'blur' }
                    ],
                }
            };
        },
        created(){
            this.fetchData();
        },
        computed:{
            ...mapState([
                'tags',
                'tag',
            ])
        },
        mounted() {
            this.initialize();
        },
        methods: {
            fetchData(){
                this.$store.dispatch('getTags');
            },
            submitForm(formName) {
                let _this = this;
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        let formData = {
                            title : this.form.title,
                            cover : this.form.cover,
                            tags  : this.form.tags,
                            body  : this.form.body
                        };
                        let loading = _this.$loading({fullscreen :true});
                        window.axios.post('/api/articles' , formData)
                            .then(response => {
                                loading.close();

                                this.$notify({
                                    title: '成功',
                                    message: '操作成功, 1.5秒后自动跳转',
                                    duration:1500,
                                    type: 'success'
                                });

                                setTimeout(function () {
                                    _this.$router.push({name:'articles'});
                                },1500);


                            }).catch(error => {
                            errorMessage()
                        });

                    } else {
                        return false;
                    }
                });
            },
            handleSuccess(file, fileList) {
                this.form.cover = file.path;
            },
            handleError(file) {
                console.log(file);
            },
            handleRemove(file){
                this.form.cover = '';
            },
            handleTagSelect(tag){
                this.form.tags.push(tag.name)
            },
            handleTagRemove(tag , id){
                let tags = this.form.tags;
                for ( let t in tags){
                    if (tags[t] == tag){
                        console.log(t)
                    }
                }
            },
            ...mapActions([
                'postArticle',
                'putTag'
            ]),
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
                    uploadUrl:'/api/upload',
                    uploadFieldName:'file',
                    jsonFieldName:'path'
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

<style lang="scss" scoped>
    .is-error{
        .el-upload-dragger ,.multiselect__tags,.editor-toolbar , .cm-s-paper{
            border-color:red;
        }
    }
    #textarea_body{
    .el-form-item__error{
        top:90% !important;
    }
    .CodeMirror{
        z-index:0 !important;
    }
    }
</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

