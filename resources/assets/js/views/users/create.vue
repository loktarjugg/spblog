<template lang="html">
    <div id="content">
        <h3>新增用户</h3>
        <div id="form">
            <el-form :model="form" :rules="rules" ref="form" label-width="100px" class="demo-ruleForm">

                <el-form-item label="邮箱" prop="email" :span="2">
                    <el-input v-model="form.email"></el-input>
                </el-form-item>
                <el-form-item label="用户名" prop="name" :span="5">
                    <el-input v-model="form.name"></el-input>
                </el-form-item>

                <el-form-item label="头像" prop="avatar">
                    <Upload v-on:watch-file="watchFile" v-bind:fileList="form.fileList"></Upload>
                    <input hidden v-model="form.avatar">
                </el-form-item>

                <el-form-item label="密码" prop="password" :span="5">
                    <el-input type="password" v-model="form.password" auto-complete="off"></el-input>
                </el-form-item>

                <el-form-item label="是否启用" prop="delivery">
                    <el-switch on-text="" off-text="" v-model="form.status"></el-switch>
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" @click="submitForm('form')">立即创建</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>

<script>
    import { errorMessage } from '../errors/errorMessage'
    import Upload from '../../components/upload.vue';

    export default {
        components: {
            Upload,
        },
        data() {
            return {
                form:{
                    name: '',
                    avatar: '',
                    email:'',
                    password:'',
                    fileList:[],
                    status:false
                },
                rules: {
                    name: [
                        { required: true, message: '请输入用户名', trigger: 'blur,change' },
                        { min: 2, max: 30, message: '长度在 2 到 30 个字符', trigger: 'blur,change' }
                    ],
                    email :[
                        { required: true,message:'请输入 E-mail 地址', trigger: 'blur' },
                        {type: 'email',message:'必须是一个正确的邮箱地址',trigger: 'blur,change'}
                    ],
                    password : [
                        {required:true ,message:'请输入密码'},
                        {min:6 , max:30 ,message:'密码的长度在6 到 30 个字符之间'}
                    ],
                    avatar : [
                        { type:'url',message:'必须是一个正确的头像地址',trigger: 'blur'}
                    ]
                }
            };
        },
        methods: {
            submitForm(formName) {
                let _this = this;
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        let formData = {
                            name : this.form.name,
                            avatar : this.form.avatar,
                            password  : this.form.password,
                            email  : this.form.email,
                            status : this.form.status
                        };
                        let loading = this.$loading({fullscreen :true});
                        window.axios.post('/api/users' , formData)
                            .then(response => {
                                loading.close();
                                this.$notify({
                                    title: '成功',
                                    message: '操作成功, 1.5秒后自动跳转',
                                    duration:1500,
                                    type: 'success'
                                });

                                setTimeout(function () {
                                    _this.$router.push({name:'users'});
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
                this.form.avatar = file;
            },
        }
    }
</script>