<template>
    <div>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Producten aanpassen</h1>
                <p>Pas de producten aan</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Producten aanpassen</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="tile">
                    <h3 class="tile-title">Producten
                        <router-link to="/admin/products/create" class="btn btn-link float-right">Product aanmaken</router-link>
                    </h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Category</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="product in products">
                            <td>
                                <router-link :to="`/admin/products/${product.id}`">
                                    {{ product.title }}
                                </router-link>
                            </td>
                            <td>
                                <product-category-select :product="product.id"></product-category-select>
                            </td>
                            <td class="text-right">
                                <router-link :to="`/admin/products/${product.id}/edit`">Aanpassen</router-link>
                                <a href="" @click.prevent="remove(product.id)">Verwijderen</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ProductCategorySelect from './ProductCategorySelect'
    export default {
        name: "Products",
        components: {
            ProductCategorySelect
        },
        methods:{
            remove(id) {
                axios.delete(`/products/${id}`)
                .then(response => {
                    if (response.data.success) {
                        this.$store.dispatch('getAllProducts')
                    }
                })
            }
        },
        computed: {
            products() {
                return this.$store.getters.allProducts
            }
        },
        created() {
            this.$store.dispatch('getAllProducts')
        }
    }
</script>

<style scoped>

</style>