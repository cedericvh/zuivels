<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <div class="alert alert-danger" v-if="error.message">
                            <strong>Error!</strong> {{ error.message }}.
                        </div>
                        <form @submit.prevent="login">
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="username" required autofocus v-model="credentials.username">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required v-model="credentials.password">
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
                                    <router-link to="/register" class="btn btn-link">
                                        Register
                                    </router-link>
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
                error: {},
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
                this.error = {}
                axios.post('/oauth/token', this.credentials)
                .then(response => {
                    this.$store.dispatch('setAccessToken', response.data.access_token)
                    axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.access_token}`
                    this.getUser()
                }).catch(error => {
                    this.error = error.response.data
                })
            },
            getUser() {
                axios.get('/user').then(response => {
                    this.$store.dispatch('setUser', response.data.user)
                    if (response.data.user.is_admin) {
                        this.$router.push({path: '/'})
                    } else {
                        this.$router.push({path: '/aanbod'})
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>