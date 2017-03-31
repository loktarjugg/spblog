<template lang="html">
    <div id="content">
        <h3>添加分享</h3>
        <div id="form">
            <el-form :model="form" :rules="rules" ref="form" label-width="100px" class="demo-ruleForm">
                <el-form-item label="标题" prop="title" :span="5">
                    <el-input v-model="form.title"></el-input>
                </el-form-item>

                <el-form-item label="Logo" prop="logo">
                    <Upload v-on:watch-file="watchFile" v-bind:fileList="form.fileList"></Upload>
                    <input hidden v-model="form.logo">
                </el-form-item>

                <el-form-item label="标签" prop="tags">
                    <Taggles v-bind:value="form.tags" :groups="'share'" v-on:taggle="watchTaggle"></Taggles>
                    <input hidden v-model="form.tags">
                </el-form-item>

                <el-form-item label="介绍" prop="content">
                    <el-input type="textarea" v-model="form.content" :rows="5"></el-input>
                </el-form-item>

                <el-form-item label="链接" prop="link" :span="2">
                    <el-input v-model="form.link"></el-input>
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
    import { errorMessage } from '../errors/errorMessage'
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
                    logo: '',
                    tags :[],
                    content:'',
                    link:'',
                    fileList:[]
                },
                rules: {
                    title: [
                        { required: true, message: '请输入标题', trigger: 'blur' },
                        { min: 2, max: 50, message: '长度在 2 到 50 个字符', trigger: 'blur' }
                    ],
                    logo :[
                        { required: true,message:'必须上传一张封面', trigger: 'blur' }
                    ],
                    tags : [
                        {required:true ,message:'必须选择一个标签'}
                    ],
                    content : [
                        {required:true ,message:'介绍不能为空' ,trigger:'blur'},
                        { min: 5 ,max:80, message: '不少于5个字,最多80字', trigger: 'blur' }
                    ],
                    link:[
                        {required:true ,message:'必须填写跳转的链接' ,trigger:'blur'},
                        {type:'url' ,message:'必须是一个正确的链接',trigger:'blur'},
                    ],
                }
            };
        },
        methods: {
            submitForm(formName) {
                let _this = this;
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        let formData = {
                            title : this.form.title,
                            logo : this.form.logo,
                            tags  : this.form.tags,
                            content  : this.form.content,
                            link  : this.form.link,
                        };
                        let loading = _this.$loading({fullscreen :true});

                        window.axios.post('/api/shares' , formData)
                            .then(response => {
                                loading.close();
                                this.$notify({
                                    title: '成功',
                                    message: '操作成功, 1.5秒后自动跳转',
                                    duration:1500,
                                    type: 'success'
                                });
                                _this.getShares();

                                setTimeout(function () {
                                    _this.$router.push({name:'shares'});
                                },1500);

                            }).catch(error => {
                                loading.close();
                        });

                    } else {
                        return false;
                    }
                });
            },
            watchFile(file){
                this.form.logo = file;
            },
            watchTaggle(tag){
                this.form.tags.push({
                    name:tag
                });
            },
            ...mapActions(['getShares'])

        }
    }
</script>