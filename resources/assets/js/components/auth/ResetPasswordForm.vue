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
                                    <label for="password" class="col-sm-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" :class="{'is-invalid': errors.password}" name="password" required autofocus v-model="data.password">
                                        <small class="text-danger" v-if="errors.password">{{errors.password[0]}}</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-sm-4 col-form-label text-md-right">Paswoord bevestigen</label>
                                    <div class="col-md-6">
                                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autofocus v-model="data.password_confirmation">
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Opnieuw instellen
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
    name: 'ResetPasswordForm',
    props: ['token'],
    data () {
        return {
            alert: {
                type: 'success',
                message: ''
            },
            errors: {},
            data: {
                token: this.token,
                email: '',
                password: '',
                password_confirmation: ''
            }
        }
    },
    methods: {
        submit () {
            this.errors = {}
            axios.post('/password/reset', this.data)
            .then(response => {
                this.alert.type = 'success'
                this.alert.message = response.data.status
                this.$router.push('/login')
            }).catch(error => {
                this.alert.type = 'danger'
                this.alert.message = error.response.data.message
                this.errors = error.response.data.errors
            })
        },
        getUser () {
            axios.get('/password/email/' + this.token)
            .then(response => {
                this.data.email = response.data.email
            }).catch(error => {
                this.alert.type = 'danger'
                this.alert.message = error.response.data.email
            })
        }
    },
    created () {
        this.getUser()
    }
}

</script>

<style scoped>

</style>
