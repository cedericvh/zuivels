<template>
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Paswoord resetten</div>
                        <div class="card-body">
                            <div class="alert" :class="alert.type === 'success' ? 'alert-success' : 'alert-danger'" v-if="alert.message">
                                <strong>{{alert.type === 'success' ? 'Success' : 'Error'}}!</strong> {{ alert.message }}.
                            </div>
                            <form @submit.prevent="submit">
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label text-md-right">E-mail Adres</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="username" required autofocus v-model="email">
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Paswoord link verzenden
                                        </button>
                                        <router-link to="/login" class="btn btn-link">
                                            Login
                                        </router-link>
                                        <router-link to="/register" class="btn btn-link">
                                            Registreer
                                        </router-link>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    name: 'ForgotPassword',
    data() {
        return {
            alert: {
                type: 'success',
                message: ''
            },
            email: ''
        }
    },
    methods: {
        submit() {
            axios.post('/password/email', {email: this.email})
            .then(response => {
                this.alert.type = 'success'
                this.alert.message = response.data.status
            }).catch(error => {
                this.alert.type = 'danger'
                this.alert.message = error.response.data.email
            })
        }
    }
}
</script>

<style scoped>

</style>
