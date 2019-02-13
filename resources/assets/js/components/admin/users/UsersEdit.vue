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
                            <label for="name">Naam</label>
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
                            <label for="address2">Straat & Huisnummer</label>
                            <input type="address2" name="address2" id="address2" class="form-control" v-model="newUser.address.address2" :class="{ 'is-invalid': errors.address2 }">
                            <span class="invalid-feedback" v-if="errors.address2">
                                <strong>{{ errors.address2[0] }}</strong>
                            </span>
                        </div>  
                        <div class="form-group">
                            <label for="address1">Postcode</label>
                            <input type="address1" name="address1" id="address1" class="form-control" v-model="newUser.address.address1" :class="{ 'is-invalid': errors.address1 }">
                            <span class="invalid-feedback" v-if="errors.address1">
                                <strong>{{ errors.address1[0] }}</strong>
                            </span>
                        </div> 
                        <div class="form-group">
                            <label for="city">Gemeente</label>
                            <input type="city" name="city" id="city" class="form-control" v-model="newUser.address.city" :class="{ 'is-invalid': errors.city }">
                            <span class="invalid-feedback" v-if="errors.city">
                                <strong>{{ errors.city[0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Telefoon</label>
                            <input type="text" name="telephone" id="telephone" class="form-control" v-model="newUser.address.telephone" :class="{ 'is-invalid': errors.telephone }">
                            <span class="invalid-feedback" v-if="errors.telephone">
                                <strong>{{ errors.telephone[0] }}</strong>
                            </span>
                        </div> 
                        <div class="form-group">
                            <label for="fax">Fax</label>
                            <input type="text" name="fax" id="fax" class="form-control" v-model="newUser.address.fax" :class="{ 'is-invalid': errors.fax }">
                            <span class="invalid-feedback" v-if="errors.fax">
                                <strong>{{ errors.fax[0] }}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="fax">Opmerking</label>
                            <input type="text" name="remark" id="remark" class="form-control" v-model="newUser.address.remark" :class="{ 'is-invalid': errors.remark }">
                            <span class="invalid-feedback" v-if="errors.remark">
                                <strong>{{ errors.remark[0] }}</strong>
                            </span>
                        </div>                          
                        
                        
                        <div class="form-group">
                            <label for="roles">Rollen</label>
                            <multiselect :options="roles"
                                         v-model="newUser.roles"
                                         track-by="id"
                                         label="name"
                                         multiple
                                         :hideSelected="true"
                            ></multiselect>
                        </div>
                        <div class="form-group">
                            <label for="shippingrounds">Leveringsronde</label>
                            <multiselect :options="shippingrounds"
                                         v-model="newUser.shippinground"
                                         track-by="id"
                                         label="name"
                                         
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
                newUser: {                
                  address: {}
                },
                roles: [],
                shippingrounds:[],
                errors: {}
            }
        },
        components: {Multiselect},
        methods: {
            fetchData() {
                axios.get(`/users/${this.id}`).then(response => (this.newUser = response.data.user))
                axios.get('/roles').then(response => this.roles = response.data.roles)
                axios.get('/shippingrounds').then(response => this.shippingrounds = response.data.shippingrounds)
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