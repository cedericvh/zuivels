<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" required autofocus :class="{ 'is-invalid': errors.name }" v-model="newUser.name">
                                    <span class="invalid-feedback" v-if="errors.name">
                                        <strong>{{ errors.name[0] }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" required :class="{ 'is-invalid': errors.email }" v-model="newUser.email">
                                    <span class="invalid-feedback" v-if="errors.email">
                                        <strong>{{ errors.email[0] }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control " name="password" required :class="{ 'is-invalid': errors.password }" v-model="newUser.password">
                                    <span class="invalid-feedback" v-if="errors.password">
                                        <strong>{{ errors.password[0] }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required v-model="newUser.password_confirmation">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
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
    export default {
        name: "Register",
        data() {
            return {
                errors: {},
                newUser: {
                    name: '',
                    email: '',
                    password: ''
                }
            }
        },
        methods: {
            submit() {
                axios.post('/register', this.newUser)
                .then(response => {
                    if(response.data.success) {
                        this.$router.push('/login')
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