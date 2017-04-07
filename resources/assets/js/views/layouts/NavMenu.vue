<template lang="html">
    <el-menu default-active="1" id="nav-menu">
        <div class="logo">
            <router-link to="/admin">
                <h1>Spblog</h1>
            </router-link>
        </div>
        <el-menu-item index="2"><router-link to="/admin/articles" class="nav-link"><i class="iconfont">&#xe601;</i>  文章管理</router-link></el-menu-item>
        <el-menu-item index="2"><router-link to="/replies" class="nav-link"><i class="iconfont">&#xe670;</i>  评论管理</router-link></el-menu-item>
        <el-menu-item index="2"><router-link to="/admin/shares" class="nav-link"><i class="iconfont">&#xe636;</i>  友情链接</router-link></el-menu-item>
        <el-menu-item index="2"><router-link to="/users" class="nav-link"><i class="iconfont">&#xe66a;</i>  用户管理</router-link></el-menu-item>
        <el-menu-item index="2"><router-link to="/page3" class="nav-link"><i class="iconfont">&#xe600;</i>  基础设置</router-link></el-menu-item>
    </el-menu>
</template>