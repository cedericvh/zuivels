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
                        <router-link to="/admin/products/import" class="btn btn-link float-right">Import Products</router-link>
                    </h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Naam</th>
                            <th>Te bestellen</th>
                            <th>Category</th>
                            <th></th>
                        </tr>
                        </thead>
                        <draggable class="cursor-pointer" v-model="products" element="tbody" :options="options" @sort="sorted">
                            <tr v-for="product in products" :key="product.id">
                                <td>{{product.sorting_id}}</td>
                                <td>
                                    <router-link :to="`/admin/products/${product.id}`">
                                        {{ product.title }}
                                    </router-link>
                                </td>
                                <td>
                                    
                                        {{ product.toorder }}
                                    
                                </td>                                
                                <td>
                                    <span class="category" v-for="category in product.categories">
                                        {{ category.title }}
                                    </span>
                                </td>
                                <td class="text-right">
                                    <router-link :to="`/admin/products/${product.id}/edit`">Aanpassen</router-link>
                                    <a href="" @click.prevent="remove(product.id)">Verwijderen</a>
                                </td>
                            </tr>
                        </draggable>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Draggable from 'vuedraggable'

    export default {
        name: "Products",
        data() {
            return {
                options: {
                    sort: true,
                    group: 'sorting'
                },
                categories: [],
                curPage: 1
            }
        },
        components: {
            Draggable
        },
        methods: {
            remove(id) {
                axios.delete(`/products/${id}`)
                .then(response => {
                    if (response.data.success) {
                        this.$store.dispatch('getAllProducts')
                    }
                })
            },
            sorted(e) {
                let productIds = this.products.map(product => {
                    return product.id
                })

                axios.post('/products/sort', productIds)
                .then(response => {
                    if(response.data.success) this.$store.dispatch('getAllProducts')
                }).catch(response => console.log(response.data))
            },
            getCategories() {
                axios.get('/categories/leaves')
                .then(response => this.categories = response.data.categories)
                .catch(response => console.log(response.data))
            }
        },
        computed: {
            products: {
                get() {
                    return this.$store.getters.allProducts
                },
                set(value) {
                    this.$store.dispatch('sort', value)
                }
            },
            paginateData() {
                return this.$store.getters.paginateData
            }
        },
        created() {
            this.getCategories()
            this.$store.dispatch('getAllProducts')
        }
    }
</script>

<style scoped>
    .cursor-pointer {
        cursor: pointer;
    }
    .category {
        padding: 4px 10px;
        border-radius: 5px;
        margin-right: 10px;
        color: #fff;
        line-height: 1;
        background: #41b883;
        white-space: nowrap;
        overflow: hidden;
        max-width: 100%;
        text-overflow: ellipsis;
    }
</style>