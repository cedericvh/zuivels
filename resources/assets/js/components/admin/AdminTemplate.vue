<template>
    <div>
        <app-header></app-header>
        <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
        <side-bar></side-bar>
        <main class="app-content">
            <router-view></router-view>
        </main>
        <app-footer></app-footer>
    </div>
</template>

<script>
    import AppHeader from './AppHeader.vue'
    import AppFooter from './AppFooter.vue'
    import SideBar from './SideBar'

    export default {
        name: "AdminTemplate",
        components: {
            SideBar,
            AppHeader,
            AppFooter
        }
    }
</script>

<style scoped>

</style>