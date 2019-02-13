<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-header">
                    Ronde aanmaken
                    <router-link to="/admin/shippingrounds" class="btn btn-link float-right">Back</router-link>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submit">
                        <div class="form-group">
                            <label for="name">Naam</label>
                            <input type="text" name="name" id="name" class="form-control" v-model="newShippinground.name" :class="{ 'is-invalid': errors.name }">
                            <span class="invalid-feedback" v-if="errors.name">
                                <strong>{{ errors.name[0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="description">Inhoud</label>
                            <input type="text" name="description" id="description" class="form-control" v-model="newShippinground.description" :class="{ 'is-invalid': errors.description }">
                            <span class="invalid-feedback" v-if="errors.description">
                                <strong>{{ errors.description[0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="description">Extra opmerking</label>
                            <input type="text" name="extra_remark" id="extra_remark" class="form-control" v-model="newShippinground.extra_remark" :class="{ 'is-invalid': errors.extra_remark}">
                            <span class="invalid-feedback" v-if="errors.extra_remark">
                              <strong>{{ errors.extra_remark[0] }}</strong>
                            </span>
                        </div>                         
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Aanmaken</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    

    export default {
        name: "ShippingroundsCreate",
        data() {
            return {
                newShippinground: {},
                errors: {}
            }
        },
        components: {},
        methods: {
            submit() {
                axios.post('/shippingrounds', this.newShippinground)
                .then(response => {
                    if (response.data.success) {
                        this.$router.push('/admin/shippingrounds')
                    }
                }).catch(error => {
                    this.errors = error.response.data.errors
                })
            }
        },
        created() {
            this.fetchData()
        }
    }
</script>

<style scoped>

</style>