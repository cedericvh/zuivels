<template>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Product aanpassen
                    <router-link to="/admin/products" class="btn btn-link float-right">Keer terug</router-link>
                </div>
                <div class="panel-body">
                    <form @submit.prevent="submit">
                        <div class="form-group">
                            <label for="title">Product naam</label>
                            <input type="text" name="title" id="title" class="form-control" v-model="product.title" :class="{ 'is-invalid': errors.title }">
                            <span class="invalid-feedback" v-if="errors.title">
                                <strong>{{ errors.title[0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="description">Omschrijving</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control" v-model="product.description"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Aanpassen</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductsEdit",
        props: ['id'],
        data() {
            return {
                errors: {},
                product: {}
            }
        },
        methods: {
            submit() {
                axios.put(`/products/${this.id}`, this.product)
                .then(response => {
                    if (response.data.success) {
                        this.$router.push('/admin/products')
                    }
                }).catch(error => {
                    this.errors = error.response.data.errors
                })
            }
        },
        mounted() {
            axios.get(`/products/${this.id}/edit`)
            .then(response => this.product = response.data.product)
        }
    }
</script>

<style scoped>

</style>