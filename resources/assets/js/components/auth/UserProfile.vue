<template>
    <main>
        <section class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="/images/catalog-slide.jpg" alt="First slide">
                    <p class="caption">Jouw gebruikersgegevens</p>
                </div>
            </div>
        </section>
        <br>
        <div class="container" v-if="user">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="introtekst_registreren">

                    </div>
                    <div class="card">
                        <div class="card-header">Wijzig jouw gegevens hier</div>
                        <div class="card-body">
                            <p>Beste bezoeker,<br>
                                Hier kan je een informatie terugvinden over onze rondes.</p>

                            <p v-if="user.shippinground">Jouw levering is op volgende ronde : {{user.shippinground.name}}</p>
                            <p v-if="user.shippinground">{{user.shippinground.description}}</p>
                            <p>
                                <router-link v-if="user.shippinground && user.shippinground.file1" :to="user.shippinground.file1" target="_blank">Extra info 1 - leveringsdatums van uw ronde</router-link>
                            </p>
                            <p>
                                <router-link v-if="user.shippinground && user.shippinground.file2" :to="user.shippinground.file2" target="_blank">Extra info 2 - laatste productenlijst</router-link>
                            </p>
                            <p>
                                <router-link v-if="user.shippinground && user.shippinground.file3" :to="user.shippinground.file3" target="_blank">Extra info 3 - {{user.shippinground.file3}}</router-link>
                            </p>

                            <p>Pas hieronder jouw gegevens aan:</p>
                            <form @submit.prevent="submit">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Naam</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" autofocus :class="{ 'is-invalid': errors.name }" v-model="newUser.name">
                                        <span class="invalid-feedback" v-if="errors.name">
                                        <strong>{{ errors.name[0] }}</strong>
                                    </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">E-mail Adres</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" :class="{ 'is-invalid': errors.email }" v-model="newUser.email">
                                        <span class="invalid-feedback" v-if="errors.email">
                                        <strong>{{ errors.email[0] }}</strong>
                                    </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Paswoord</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control " name="password" :class="{ 'is-invalid': errors.password }" v-model="newUser.password">
                                        <span class="invalid-feedback" v-if="errors.password">
                                        <strong>{{ errors.password[0] }}</strong>
                                    </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Bevestig paswoord</label>
                                    <div class="col-md-6">
                                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" v-model="newUser.password_confirmation">
                                        <span class="invalid-feedback" v-if="errors.password_confirmation">
                                        <strong>{{ errors.password_confirmation[0] }}</strong>
                                    </span>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-group row" style="display:none;">
                                    <label for="country" class="col-md-4 col-form-label text-md-right">Country</label>
                                    <div class="col-md-6">
                                        <input id="country" type="text" class="form-control" name="country" :class="{ 'is-invalid': errors['address.country'] }" v-model="newUser.address.country">
                                        <span class="invalid-feedback" v-if="errors['address.country']">
                                        <strong>{{ errors['address.country'][0] }}</strong>
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="city" class="col-md-4 col-form-label text-md-right">Gemeente/Dorp</label>
                                    <div class="col-md-6">
                                        <input id="city" type="text" class="form-control " name="city" :class="{ 'is-invalid': errors['address.city'] }" v-model="newUser.address.city">
                                        <span class="invalid-feedback" v-if="errors['address.city']">
                                        <strong>{{ errors['address.city'][0] }}</strong>
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address1" class="col-md-4 col-form-label text-md-right">Postcode</label>
                                    <div class="col-md-6">
                                        <input id="address1" type="text" class="form-control " name="address1" :class="{ 'is-invalid': errors['address.address1'] }" v-model="newUser.address.address1">
                                        <span class="invalid-feedback" v-if="errors['address.address1']">
                                        <strong>{{ errors['address.address1'][0] }}</strong>
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address2" class="col-md-4 col-form-label text-md-right">Adres en huisnummer</label>
                                    <div class="col-md-6">
                                        <input id="address2" type="text" class="form-control " name="address2" :class="{ 'is-invalid': errors['address.address2'] }" v-model="newUser.address.address2">
                                        <span class="invalid-feedback" v-if="errors['address.address2']">
                                        <strong>{{ errors['address.address2'][0] }}</strong>
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="telephone" class="col-md-4 col-form-label text-md-right">Telefoonnummer</label>
                                    <div class="col-md-6">
                                        <input id="telephone" type="text" class="form-control " name="telephone" :class="{ 'is-invalid': errors['address.telephone'] }" v-model="newUser.address.telephone">
                                        <span class="invalid-feedback" v-if="errors['address.telephone']">
                                        <strong>{{ errors['address.address2'][0] }}</strong>
                                    </span>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Gegevens aanpassen
                                        </button>
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
import Multiselect from 'vue-multiselect'

export default {
    name: 'UsersEdit',
    props: ['id'],
    data () {
        return {
            newUser: {
                name,
                address: {}
            },
            roles: [],
            shippingrounds: [],
            errors: {}
        }
    },
    components: { Multiselect },
    methods: {
        fetchData () {
            axios.get(`/users/${this.id}`).then(response => (this.newUser = response.data.user))
            axios.get('/roles').then(response => this.roles = response.data.roles)
            axios.get('/shippingrounds').then(response => this.shippingrounds = response.data.shippingrounds)
        },
        submit () {
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
    created () {
        this.fetchData()

    }
}
</script>

<style scoped>

</style>
