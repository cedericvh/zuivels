<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form @submit.prevent="login">
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" :class="{ 'is-invalid': errors.email }" name="username" required autofocus v-model="credentials.username">
                                    <span class="invalid-feedback" v-if="errors.email">
                                        <strong>{{ errors.password[0] }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" :class="{ 'is-invalid': errors.password }" name="password" required v-model="credentials.password">
                                    <span class="invalid-feedback" v-if="errors.password">
                                        <strong>{{ errors.password[0] }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="remember"> Remember Me</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                    <a class="btn btn-link" href="">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import config from '../../config'

    export default {
        name: "Login",
        data() {
            return {
                errors: {},
                credentials: {
                    username: '',
                    password: '',
                    grant_type: 'password',
                    client_id: config.client_id,
                    client_secret: config.client_secret
                }
            }
        },
        methods: {
            login() {
                this.errors = {}
                axios.create({baseURL: '/'}).post('/oauth/token', this.credentials)
                .then(response => {
                    this.$store.dispatch('setAccessToken', response.data.access_token)
                    axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.access_token}`
                    this.getUser()
                }).catch(error => {
                    if (error.response.data.errors)
                        this.errors = error.response.data.errors
                })
            },
            getUser() {
                axios.get('/user').then(response => {
                    this.$store.dispatch('setUser', response.data.user)
                    this.$router.push({path: '/'})
                })
            }
        }
    }
</script>

<style scoped>

</style>