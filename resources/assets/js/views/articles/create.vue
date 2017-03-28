<template lang="html">
    <div id="content">
        <h3>创建文章 / 作品</h3>
        <div id="form">
            <el-form :model="form" :rules="rules" ref="form" label-width="100px" class="demo-ruleForm">
                <el-form-item label="文章名称" prop="title" :span="5">
                    <el-input v-model="form.title"></el-input>
                </el-form-item>

                <el-form-item label="封面" prop="cover">
                    <Upload v-on:watch-file="watchFile" v-bind:fileList="form.file_list"></Upload>
                    <input hidden v-model="form.cover">
                </el-form-item>

                <el-form-item label="标签" prop="tags">
                    <Taggles v-bind:value="form.tags" v-on:taggle="watchTaggle"></Taggles>
                    <input hidden v-model="form.tags">
                </el-form-item>

                <el-form-item label="简介">
                    <el-input type="textarea" v-model="form.desc" :rows="5"></el-input>
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
    import SimpleMDE from 'simplemde';
    import { errorMessage } from '../errors/errorMessage'
    import '../../plugs/inline_attachment/inline-attachment.min';
    import '../../plugs/inline_attachment/codemirror-4.inline-attachment';
    import Upload from '../../components/upload.vue';
    import Taggles from '../../components/tags.vue';

    export default {
        components: {
            Upload,
            Taggles
        },
        data() {
            return {
                form:{
                    title: '',
                    cover: '',
                    tags :[],
                    body:'',
                    desc:'',
                    file_list:[]
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
                    desc : [
                        {required:true ,message:'简介不能为空' ,trigger:'blur'},
                        { min: 20 ,max:200, message: '不少于20个字,最多200字', trigger: 'blur' }
                    ],
                    body : [
                        {required:true ,message:'内容不能为空' ,trigger:'blur'},
                        { min: 1 , message: '最少1个字', trigger: 'blur' }
                    ],
                }
            };
        },
        mounted() {
            this.simplemde = new SimpleMDE({
                element: document.getElementById("textarea"),
                spellChecker:false
            });
            this.simplemde.codemirror.on('change', () => {
                this.form.body = this.simplemde.value();
            });
            //自动上传解析
            inlineAttachment.editors.codemirror4.attach(this.simplemde.codemirror, {
                uploadUrl:'/api/upload',
                uploadFieldName:'file',
                jsonFieldName:'path'
            });
        },
        methods: {
            submitForm(formName) {
                let _this = this;
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        let formData = {
                            title : this.form.title,
                            cover : this.form.cover,
                            tags  : this.form.tags,
                            body  : this.form.body,
                            description  : this.form.desc,

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
            watchFile(file){
                this.form.cover = file;
            },
            watchTaggle(tag){
                this.form.tags.push({
                    name:tag
                });
            }

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
    .CodeMirror{
        z-index:0 !important;
    }
    }
    .editor-preview-side img{
        width: 100%;
    }
</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style src="simplemde/dist/simplemde.min.css"></style>

