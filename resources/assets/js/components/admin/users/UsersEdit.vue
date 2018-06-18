<template>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-header">
                    Edit User
                    <router-link to="/admin/users" class="btn btn-link float-right">Back</router-link>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submit">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" v-model="newUser.name" :class="{ 'is-invalid': errors.name }">
                            <span class="invalid-feedback" v-if="errors.name">
                                <strong>{{ errors.name[0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" v-model="newUser.email" :class="{ 'is-invalid': errors.email }">
                            <span class="invalid-feedback" v-if="errors.email">
                                <strong>{{ errors.email[0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" v-model="newUser.password" :class="{ 'is-invalid': errors.password }">
                            <span class="invalid-feedback" v-if="errors.password">
                                <strong>{{ errors.password[0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="password">Roles</label>
                            <multiselect :options="roles"
                                         v-model="newUser.roles"
                                         track-by="id"
                                         label="name"
                                         multiple
                                         :hideSelected="true"
                            ></multiselect>
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
    import Multiselect from 'vue-multiselect'
    export default {
        name: "UsersEdit",
        props: ['id'],
        data() {
            return {
                newUser: {},
                roles: [],
                errors: {}
            }
        },
        components: {Multiselect},
        methods: {
            fetchData() {
                axios.get(`/users/${this.id}`).then(response => this.newUser = response.data.user)
                axios.get('/roles').then(response => this.roles = response.data.roles)
            },
            submit() {
                axios.put(`/users/${this.id}`, this.newUser)
                .then(response => {
                    if (response.data.success) {
                        this.$router.push('/admin/users')
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