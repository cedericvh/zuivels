<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-header">
                    Product aanpassen
                    <router-link to="/admin/products" class="btn btn-link float-right">Keer terug</router-link>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submit">
                        <div class="form-group">
                            <label for="title">Product naam</label>
                            <input type="text" name="title" id="title" class="form-control" :class="{ 'is-invalid': errors.title }">
                            <span class="invalid-feedback" v-if="errors.title">
                                <strong>{{ errors.title[0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="description">Omschrijving</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control" :class="{ 'is-invalid': errors.description }"></textarea>
                            <span class="invalid-feedback" v-if="errors.description">
                                <strong>{{ errors.description[0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="description">Te bestellen</label>
                            <input type="text" name="toorder" id="toorder" class="form-control" :class="{ 'is-invalid': errors.toorder }">
                            <span class="invalid-feedback" v-if="errors.description">
                                <strong>{{ errors.description[0] }}</strong>
                            </span>
                        </div>                        
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image" :class="{ 'is-invalid': errors.image }">
                            <span class="invalid-feedback" v-if="errors.image">
                                <strong>{{ errors.image[0] }}</strong>
                            </span>
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
        name: "ProductsCreate",
        data() {
            return {
                errors: {}
            }
        },
        methods: {
            submit(e) {
                let formData = new FormData(e.target)
                axios.post('/products', formData)
                .then(response => {
                    if (response.data.success) {
                        this.$router.push('/admin/products')
                    }
                }).catch(error => {
                    this.errors = error.response.data.errors
                })
            }
        }
    }
</script>

<style scoped>

</style>