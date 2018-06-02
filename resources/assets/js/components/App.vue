<template>
    <div>
        <admin-template v-if="user && user.is_admin"></admin-template>
        <client-template v-else></client-template>
    </div>
</template>

<script>
    import ClientTemplate from './client/ClientTemplate'
    import AdminTemplate from './admin/AdminTemplate'
    export default {
        name: "app",
        components: {
            ClientTemplate,
            AdminTemplate
        }
    }
</script>

<style scoped>

</style>