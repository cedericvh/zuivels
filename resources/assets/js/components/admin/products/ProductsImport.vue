<template>
    <div>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Import Products</h1>
                <!--<p>Pas de producten aan</p>-->
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
                    </h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="file" class="form-control" @change="uploadChanged">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary" @click="save" :disabled="!count(products)">Save</button>
                        </div>
                    </div>
                    <table class="table" v-if="count(products)">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <template v-for="(category, categoryName) in products">
                            <tr v-if="isArray(category)" v-for="(product, index) in category">
                                <td>{{product.title}}</td>
                                <td>{{categoryName}}</td>
                                <td></td>
                                <td>
                                    <button class="btn btn-link" @click="category.splice(index, 1)">Delete</button>
                                </td>
                            </tr>
                            <template v-if="!isArray(category)" v-for="(subCategory, subCategoryName) in category">
                                <tr v-for="(product, index) in subCategory">
                                    <td>{{product.title}}</td>
                                    <td>{{categoryName}}</td>
                                    <td>{{subCategoryName}}</td>
                                    <td>
                                        <button class="btn btn-link" @click="subCategory.splice(index, 1)">Delete</button>
                                    </td>
                                </tr>
                            </template>
                        </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductsImport",
        data() {
            return {
                products: {}
            }
        },
        methods: {
            uploadChanged(e) {
                let formData = new FormData
                formData.append('sheet', e.target.files[0])
                axios.post('/products/import/upload', formData)
                .then(response => {
                    this.products = response.data.products
                })
            },
            isArray(obj) {
                return Array.isArray(obj)
            },
            count(obj) {
                return Object.keys(obj).length
            },
            save() {
                axios.post('/products/import/save', this.products)
                .then(response => {
                    if (response.data.success) this.$router.push('/admin/products')
                })
            }
        }
    }
</script>

<style scoped>

</style>