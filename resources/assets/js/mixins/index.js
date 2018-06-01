import Vue from 'vue'

Vue.mixin({
    computed: {
        user() {
            return this.$store.getters.user
        }
    }
})