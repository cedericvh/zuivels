<template>
    <div>
        <app-header></app-header>
        <router-view></router-view>
        <app-footer></app-footer>
    </div>
</template>

<script>
    import AppHeader from './AppHeader.vue'
    import AppFooter from './AppFooter.vue'

    export default {
        name: "ClientTemplate",
        components: {
            AppHeader,
            AppFooter
        }
    }
</script>

<style scoped>

</style>