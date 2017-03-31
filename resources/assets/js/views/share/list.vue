<template>
    <div id="content">
        <h3>分享列表</h3>
        <div style="margin-bottom: 20px;">
            <router-link :to="{ name: 'shares-create'}">
                <el-button type="primary" >添加<i class="el-icon-plus el-icon--right"></i></el-button>
            </router-link>
        </div>
        <div class="table-template">
            <el-table
                    :data="shares.data"
                    highlight-current-row
                    style="width: 100%">
                <el-table-column
                        label="ID"
                        width="60" prop="id">
                </el-table-column>
                <el-table-column
                        property="title"
                        label="标题"
                        :show-overflow-tooltip="true"
                        width="220">
                </el-table-column>
                <el-table-column
                        property="content"
                        label="内容"
                        :show-overflow-tooltip="true"
                        width="220">
                </el-table-column>
                <el-table-column label="logo" width="80" prop="logo">
                    <template scope="scope">
                        <a :href="scope.row.logo" target="_blank"><el-icon name="picture"></el-icon></a>
                    </template>
                </el-table-column>
                <el-table-column label="链接" width="230" prop="link" :show-overflow-tooltip="true">
                    <template scope="scope">
                        <a :href="scope.row.link" target="_blank">{{ scope.row.link }}</a>
                    </template>
                </el-table-column>
                <el-table-column label="操作" prop="id">
                    <template scope="scope">
                        <el-button
                                size="small"> <router-link :to="{name: 'articles-edit' , params:{ slug: scope.row.id }}">编辑</router-link> </el-button>
                        <el-button
                                size="small"
                                type="danger"
                                @click="deleteShare(scope.row.id)">删除</el-button>
                    </template>
                </el-table-column>
            </el-table>

            <div class="pagination">
                <el-pagination v-for="meta in shares.meta"
                               @current-change="getShares"
                               :current-page="meta.current_page"
                               :page-size="meta.per_page"
                               layout="total, prev, pager, next"
                               :total="meta.total" v-show="meta.total >= 10">
                </el-pagination>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState, mapActions} from 'vuex'
    export default{
        data(){
            return{

            }
        },
        created(){
            this.getShares();
        },
        computed: mapState([
            'shares'
        ]),
        methods:{
            ...mapActions([
                'getShares',
            ]),
            deleteShare(id){
                this.$confirm('此操作将永久删除这条记录, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    window.axios.delete('/api/shares/' + id)
                        .then(response => {
                            this.getShares();
                            this.$message({
                                type: 'success',
                                message: '删除成功!'
                            });

                        }).catch(error => {
                        this.$message({
                            type: 'error',
                            message: '删除失败'
                        });
                    })
                });
            }
        },

    }
</script>