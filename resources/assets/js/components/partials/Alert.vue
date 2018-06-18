<template>
    <div v-if="alert.message" :class="`alert alert-${alert.type}`">
        <strong v-if="alert.title">{{ alert.title }}!</strong> {{ alert.message }}.
    </div>
</template>

<script>
    export default {
        name: "Alert",
        computed: {
            alert() {
                return this.$store.getters.alert
            }
        }
    }
</script>

<style scoped>

</style>