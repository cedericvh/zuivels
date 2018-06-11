<template>
    <div>
        <multiselect :options="categories"
                     v-model="selected"
                     track-by="id"
                     label="title"
                     multiple
                     :hideSelected="true"
                     @input="attachtocategory"
        ></multiselect>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'
    export default {
        name: 'ProductCategorySelect',
        data() {
            return {
                selected: this.product.categories
            }
        },
        components: {
            Multiselect
        },
        methods: {
            attachtocategory() {
                if (this.product || this.selected) {
                    axios.post('/attachtocategory/' + this.product.id + '/' + this.selected.map(item => item.id))
                    .then(response => console.log('saved successfully'))
                }
            }
        },

        props: ['product', 'categories'],

        created() {
        }

    }

</script>