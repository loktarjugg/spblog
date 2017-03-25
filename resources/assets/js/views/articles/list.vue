<template lang="html">
    <div id="content">
        <h3>文章列表</h3>
        <div style="margin-bottom: 20px;">

            <router-link :to="{ name: 'articles-create'}">
                <el-button type="primary" >创建文章 / 作品<i class="el-icon-plus el-icon--right"></i></el-button>
            </router-link>

        </div>
        <div class="articles-table">
            <el-table
                    :data="articles.data"
                    border
                    style="width: 100%">
                <el-table-column
                        label="ID"
                        width="80" prop="id">
                </el-table-column>
                <el-table-column
                        label="标题"
                        width="200" prop="title" :show-overflow-tooltip="true">
                </el-table-column>
                <el-table-column label="封面" width="70" prop="cover">
                    <template scope="scope">
                        <a :href="scope.row.cover" target="_blank"><el-icon name="picture"></el-icon></a>
                    </template>
                </el-table-column>
                <el-table-column
                        label="查看次数"
                        width="100" prop="view_count">
                </el-table-column>
                <el-table-column
                        label="点赞次数"
                        width="100" prop="vote_count">
                </el-table-column>

                <el-table-column
                        prop="tags"
                        label="标签"
                        width="200" :show-overflow-tooltip="true">
                    <template scope="scope">
                        <el-tag
                                type="gray"
                                v-for="tag in scope.row.tags">{{tag.name}}</el-tag>
                    </template>
                </el-table-column>

                <el-table-column label="操作" prop="id">
                    <template scope="scope">
                        <el-button
                                size="small"> <router-link :to="{name: 'articles-edit' , params:{ slug: scope.row.slug }}">编辑</router-link> </el-button>
                        <el-button
                                size="small"
                                type="danger"
                                @click="handleDelete(scope.row.slug)">删除</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>

        <div class="pagination" v-if="articles.meta.total > 10">
            <el-pagination v-for="meta in articles.meta"
                    @current-change="handleCurrentChange"
                    :current-page="meta.current_page"
                    :page-size="meta.per_page"
                    layout="total, prev, pager, next"
                    :total="meta.total">
            </el-pagination>

        </div>
    </div>
</template>

<script>
    import {mapState, mapActions} from 'vuex'
    export default{
        data(){
            return {
                page:{}
            }
        },
        created(){
            this.getArticles();
        },
        computed: mapState([
            'articles'
        ]),
        methods: {
            ...mapActions([
                'getArticles'
            ]),
            fetchData(){
                this.$store.dispatch('getArticles');
            },
            handleCurrentChange(val) {
                this.$store.dispatch('getArticles' , val);
            },
            handleDelete(slug) {
                this.$confirm('此操作将永久删除该博文, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    window.axios.delete('/api/articles/' + slug)
                        .then(response => {
                            this.$store.dispatch('getArticles');
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
        }
    }
</script>

<style lang="scss">
    .el-tag{
        margin: 0 3px;
    }
    .pagination{
        margin : 10px;
    }
</style>