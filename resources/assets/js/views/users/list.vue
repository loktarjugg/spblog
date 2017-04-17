<template>
    <div id="content">
        <h3>用户列表</h3>
        <div id="header-button">
            <router-link :to="{ name: 'users-create'}">
                <el-button type="primary" >创建用户<i class="el-icon-plus el-icon--right"></i></el-button>
            </router-link>
        </div>
        <div class="tables">
            <el-table
                    :data="users.data"
                    border
                    style="width: 100%">
                <el-table-column
                        label="ID"
                        width="70" prop="id">
                </el-table-column>
                <el-table-column
                        label="姓名"
                        width="200" prop="name" :show-overflow-tooltip="true">
                </el-table-column>
                <el-table-column label="头像" width="70" prop="avatar" align="center">
                    <template scope="scope">
                        <a :href="scope.row.avatar" target="_blank"><el-icon name="picture"></el-icon></a>
                    </template>
                </el-table-column>

                <el-table-column
                        label="状态"
                        width="80" prop="status" align="center">
                    <template scope="scope" >
                        <i class="el-icon-circle-check" v-if="scope.row.status" style="color:#13ce66;"></i>
                        <i class="el-icon-circle-close" style="color:#ff4949;" v-else></i>
                    </template>
                </el-table-column>

                <el-table-column label="操作" prop="id">
                    <template scope="scope">
                        <el-button
                                size="small"> <router-link :to="{name: 'users-edit' , params:{ id: scope.row.id }}">编辑</router-link> </el-button>
                        <el-button
                                size="small"
                                type="danger"
                                @click="handleDelete(scope.row.slug)">删除</el-button>
                    </template>
                </el-table-column>
            </el-table>

            <div class="pagination">
                <el-pagination v-for="meta in users.meta"
                               @current-change="getUsers"
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
            this.getUsers();
        },
        computed: mapState([
            'users'
        ]),
        methods: {
            ...mapActions(['getUsers']),
        }
    }
</script>