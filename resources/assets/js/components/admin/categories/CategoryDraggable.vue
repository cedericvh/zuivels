<template>
    <div class="col-md-6 well">
        <item :model="categories" @change="updateCategories"></item>
    </div>
</template>

<script>
    export default {
        name: 'CategoryDraggable',
        data() {
            return {
                selected: null,
                categories: {},
                options: {
                    sort: true,
                    group: 'sorting'
                },
            }
        },

        methods: {
            loadRootOptions() {
                axios.get('/categories')
                .then(response => this.categories = response.data.categories[1])
                .catch(e => this.errors.push(e))
            },
            updateCategories() {
                axios.post('/categories/update-tree', [this.categories])
            }
        },

        mounted() {
            this.loadRootOptions()
        }
    }
</script>