<template>
    <div id="upload">
        <el-upload
                class="upload-demo"
                drag
                :on-success="handleSuccess"
                :on-error="handleError"
                action="/upload"
                mutiple>
            <i class="el-icon-upload"></i>
            <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
            <div class="el-upload__tip" slot="tip">只能上传jpg/png文件，且不超过500kb</div>
        </el-upload>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                fileList: []
            };
        },
        methods: {
            handleSuccess(file, fileList) {
                this.fileList = file;
                console.log(file, fileList);
            },
            handleError(file) {
                console.log(file);
            }
        }
    }
</script>