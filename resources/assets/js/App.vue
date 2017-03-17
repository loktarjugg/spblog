<template>
    <div id="app">
        <NavMenu></NavMenu>
        <Container></Container>
    </div>
</template>

<script>
    import NavMenu from './views/layouts/NavMenu.vue'
    import Container from './views/layouts/Container.vue'
    export default {
        name: 'app',
        components: {
            NavMenu,
            Container
        }
    }
</script>

<style>
    .el-loading-mask{
        background-color:rgba(32, 32, 42, 0.63) !important;
        height:100% !important;
        width:100% !important;
    }
</style>