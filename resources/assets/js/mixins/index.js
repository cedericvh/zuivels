import Vue from 'vue'

Vue.mixin({
    computed: {
        user() {
            return this.$store.getters.user
        }
    },
    filters: {
        trans(key) {
            let translation = Object.assign({}, translations)
            for (let item of key.split('.')) translation = translation[item] ? translation[item] : key
            return typeof translation === 'string' ? translation : key
        }
    }
})