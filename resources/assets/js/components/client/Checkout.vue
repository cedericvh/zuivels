<template>
<main>
    <section class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="/images/catalog-slide.jpg" alt="First slide">
                <p class="caption">Uw order ziet er als volgt uit :</p>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Leveringsgegevens</div>
                    <div class="card-body">
                    
                    <p>
                    Hier volgt het overzicht van jouw order :
                    
                    </p>
                          <table class="table is-striped" v-if="cartProducts.length">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Hoeveelheid</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="p in cartProducts">
                                    <td>{{ p.title }}</td>
                                    <td>
                                       
                                        {{ p.quantity }}
                                        
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                    
                    </p>
                    <p>
                    Jouw leveringsgegevens zijn bij ons bekend.  Ze zijn als volgt :                    
                    </p>
                        <form @submit.prevent="submit">
                            <div class="row">

                                <div class="col-md-12">
                                
                                  <p>{{order.name}}</p>
                                  <p>Adres :</p>
                                  <ul>
                                      <li style="list-style-type:none">
                                      {{order.address2}}
                                      </li>
                                      <li style="list-style-type:none">
                                      {{order.address1}} {{order.city}}
                                      </li>                              
                                  </ul>
                                  <p>
                                      Telefoonnummer : {{order.telephone}} 
                                  </p>
                                  <p>op volgende ronde  : {{order.shippinground}}</p>
                                  <p>{{order.shippingrounddescription}}</p>
                                  
                                  <div class="form-group">
                                  <textarea v-model="order.remark" class="form-control" placeholder="Voeg nog een opmerking toe"></textarea>
                                  </div>
                                </div>
                            </div>
                            
                            <button class="btn btn-primary btn-sm float-right">Bestelling afronden</button>
                            
                            of
                                <router-link to="/aanbod">nog verder winkelen</router-link>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
</template>

<script>
    import datePicker from 'vue-bootstrap-datetimepicker'

    export default {
        name: "Checkout",
        data() {
            return {
                errors: {},
                order: {
                    name: '',
                    country: 'België',
                    city: '',
                    address1: '',
                    address2: '',
                    telephone: '',
                    shippinground: '',
                    date: '',
                    products: {},
                    remark:'',

                },
                date: '',
                
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
                for (let item of this.cartProducts) {
                
                  this.order.products[item.id] = {quantity: item.quantity, title:item.title}
          
                
                
                }
                axios.post('/orders', this.order)
                .then(response => {
                    if (response.data.success) {
                        this.$store.dispatch('emptyCart')
                        this.$store.dispatch('setAlert', 'Bedankt voor uw order.  We zullen het spoedig behandelen.')
                        this.$router.push('aanbod')
                    }
                }).catch(error => {
                    if (error.response)
                        this.errors = error.response.data.errors
                })
            }
        },
        created() {
            this.order.country = this.$store.getters.user.address.country ? this.$store.getters.user.address.country : ''
            this.order.city = this.$store.getters.user.address.city ? this.$store.getters.user.address.city : ''
            this.order.address1 = this.$store.getters.user.address.address1 ? this.$store.getters.user.address.address1 : ''
            this.order.address2 = this.$store.getters.user.address.address2 ? this.$store.getters.user.address.address2 : ''
            this.order.telephone = this.$store.getters.user.address.telephone ? this.$store.getters.user.address.telephone : ''
            this.order.name = this.$store.getters.user.name ? this.$store.getters.user.name : ''
            this.order.shippinground = this.$store.getters.user.shippinground.name ? this.$store.getters.user.shippinground.name : ''
            this.order.shippingrounddescription = this.$store.getters.user.shippinground.description ? this.$store.getters.user.shippinground.description : ''
            this.order.shippingroundfile1 = this.$store.getters.user.shippinground.file1 ? this.$store.getters.user.shippinground.file1 : ''
            this.order.shippingroundfile2 = this.$store.getters.user.shippinground.file2 ? this.$store.getters.user.shippinground.file2 : ''
            this.order.shippingroundfile3 = this.$store.getters.user.shippinground.file3 ? this.$store.getters.user.shippinground.file3 : ''
            
            this.order.date = Date.now()
        }
    }
</script>

<style scoped>

</style>
