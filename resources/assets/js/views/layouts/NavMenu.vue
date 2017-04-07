<template lang="html">
    <el-menu default-active="1" id="nav-menu">
        <div class="logo">
            <router-link to="/admin">
                <h1>Smalltiger</h1>
            </router-link>
        </div>
        <el-submenu index="1">
            <template slot="title"><i class="el-icon-menu"></i>文章管理</template>
            <el-menu-item index="1-1">
                <router-link to="/admin/articles" class="nav-link">文章列表</router-link>
            </el-menu-item>
        </el-submenu>

        <el-menu-item index="2"><router-link to="/admin/shares" class="nav-link"><i class="el-icon-share"></i>分享</router-link></el-menu-item>

        <el-menu-item index="2"><router-link to="/page3" class="nav-link"><i class="el-icon-message"></i>基础设置</router-link></el-menu-item>
    </el-menu>
</template>