<template>
    <div id="upload">
        <el-upload
                class="upload-demo"
                drag
                :on-success="handleSuccess"
                :on-error="handleError"
                :on-remove="handleRemove"
                action="/api/upload"
                :file-list="fileList"
                mutiple>
            <i class="el-icon-upload"></i>
            <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
        </el-upload>
    </div>
</template>

<script>

    import { errorMessage } from '../views/errors/errorMessage'
    export default {
        props:{
            fileList:{
                default:[],
                type:Array
            }
        },
        methods: {
            handleSuccess(file) {
                this.$emit('watch-file' , file.path);
            },
            handleError(file) {
                errorMessage('文件上传失败！');
            },
            handleRemove(){
                this.$emit('watch-file' , '');
            },
        }
    }
</script>