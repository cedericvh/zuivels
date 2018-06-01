<template>
    <div>
        <select v-model="selected" name="categories" id="categories" class="form-control" @change="attachtocategory" multiple>
            <option v-for="category in categories"
                    :key="category.id"
                    :value="category.id">
                @{{ category.title }}
            </option>
        </select>
    </div>
</template>

<script>
    export default {
        name: 'ProductCategorySelect',
        data() {
            return {
                categories: [],
                selected: []
            }
        },

        methods: {
            fetchcategories() {
                axios.get('/cats')
                .then(response => this.categories = response.data.categories[1].children)
                .catch(response => console.log(response.data))
            },

            attachtocategory() {
                if (this.product || this.selected) {
                    axios.post('/attachtocategory/' + this.product + '/' + this.selected)
                    .then(response => console.log('saved successfully'))
                }
            },

            fetchattachedcategories() {
                axios.get('/fetchattachedcategories/' + this.product)
                .then(response => this.selected = response.data.categories)
                .catch(response => console.log(response.data))

            }
        },

        props: ['product'],

        created() {
            this.fetchcategories()
            this.fetchattachedcategories(this.product)
        }

    }

</script>