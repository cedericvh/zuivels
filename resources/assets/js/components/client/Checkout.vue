<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Checkout</div>
                    <div class="card-body">
                        <form @submit.prevent="submit">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country" class="col-form-label text-md-right">Country</label>
                                        <input id="country" type="text" class="form-control" v-model="order.country" :class="{ 'is-invalid': errors.country }" name="country" autofocus>
                                        <span class="invalid-feedback" v-if="errors.country">
                                            <strong>{{ errors.country[0] }}</strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city" class="col-form-label text-md-right">City</label>
                                        <input id="city" type="text" class="form-control" v-model="order.city" :class="{ 'is-invalid': errors.city }" name="city">
                                        <span class="invalid-feedback" v-if="errors.city">
                                            <strong>{{ errors.city[0] }}</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address1" class="col-form-label text-md-right">Address 1</label>
                                        <input id="address1" type="text" class="form-control" v-model="order.address1" :class="{ 'is-invalid': errors.address1 }" name="address1">
                                        <span class="invalid-feedback" v-if="errors.address1">
                                            <strong>{{ errors.address1[0] }}</strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address2" class="col-form-label text-md-right">Address 2</label>
                                        <input id="address2" type="text" class="form-control" v-model="order.address2" :class="{ 'is-invalid': errors.address2}" name="address2">
                                        <span class="invalid-feedback" v-if="errors.address2">
                                            <strong>{{ errors.address2[0] }}</strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address2" class="col-form-label text-md-right">Date</label>
                                        <date-picker readonly v-model="order.date" :class="{ 'is-invalid': errors.address2}" name="address2" :config="options" class="bg-white"></date-picker>
                                        <span class="invalid-feedback" v-if="errors.date">
                                            <strong>{{ errors.date[0] }}</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm float-right">Complete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import datePicker from 'vue-bootstrap-datetimepicker'

    export default {
        name: "Checkout",
        data() {
            return {
                errors: {},
                order: {
                    country: '',
                    city: '',
                    address1: '',
                    address2: '',
                    date: '',
                    products: {}
                },
                date: new Date,
                options: {
                    format: 'DD/MM/YYYY HH:mm',
                    useCurrent: true,
                    minDate: moment(),
                    ignoreReadonly: true
                }
            }
        },
        components: {datePicker},
        computed: {
            cartProducts() {
                return this.$store.getters.cartProducts
            }
        },
        methods: {
            submit() {
                this.errors = {}
                for (let item of this.cartProducts) this.order.products[item.id] = {quantity: item.quantity}
                axios.post('/orders', this.order)
                .then(response => {
                    if (response.data.success) {
                        this.$store.dispatch('emptyCart')
                        this.$store.dispatch('setAlert', 'Thanks for order.  We will process this as soon as possible.')
                        this.$router.push('aanbod')
                    }
                }).catch(error => {
                    if (error.response)
                        this.errors = error.response.data.errors
                })
            }
        },
        created() {
            this.order.country = this.user.address ? this.user.address.country : ''
            this.order.city = this.user.address ? this.user.address.city : ''
            this.order.address1 = this.user.address ? this.user.address.address1 : ''
            this.order.address2 = this.user.address ? this.user.address.address2 : ''
        }
    }
</script>

<style scoped>

</style>
