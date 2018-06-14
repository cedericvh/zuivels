<template>
    <div>
        <h3>Productsoort</h3>
        <treeselect
                :load-root-options="loadRootOptions"
                :auto-load-root-options="true"
                :multiple="true"
                :normalizer="normalizer"
                :always-open="true"
                :default-expand-level="0"
                :clearable="true"
                :searchable="true"
                :flat="true"
                :value="selected"
                v-model="selected"
                @input="addSelCats"
        />
    </div>
</template>

<script>
    import Treeselect from '@riophae/vue-treeselect'
    export default {
        name: "TreeSelect",
        components: {
            Treeselect
        },
        data() {
            return {
                selected: [],
                options: [],
            }
        },
        methods: {
            normalizer(node) {
                return {
                    id: node.id,
                    label: node.title,
                    children: node.children
                }
            },
            loadRootOptions(callback) {
                axios.get('/categories')
                .then(response => callback(null, response.data.categories[1].children))
                .catch(response => console.log(response.data))
            },
            addSelCats() {
                this.$store.dispatch('setCategories', this.selected)
                this.$store.dispatch('getFilteredProducts', this.selected)
            },
        },
        created() {
            this.selected = this.$store.getters.selectedCategories
        }
    }
</script>

<style scoped>

</style>