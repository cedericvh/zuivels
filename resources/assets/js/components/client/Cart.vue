<template>
    <div>
        <section class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="/images/catalog-slide.jpg" alt="First slide">
                    <p class="caption">Ontdek ons aanbod</p>
                </div>
            </div>
        </section>

        <section class="catalog">
            <div class="container">
                <div class="row">
                    <div class="side col-md-12 order-md-12 mb-12">
                        <div class="cart">
                            <h1 class="title">Winkelmandje</h1>
                            <p v-if="!cartProducts.length">
                                <i>Jouw winkelmandje is leeg !</i> Voeg snel iets toe !
                                <!--<span>{{ message }}</span>-->
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
                                    <td>{{ p.quantity }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <p>
                                <button v-show="cartProducts.length" class='btn btn-primary btn-sm' @click='checkout'>
                                    Uw bestelling plaatsen
                                </button>
                                of <router-link to="/aanbod">verder winkelen</router-link>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "Cart",
        computed: {
            cartProducts() {
                return this.$store.getters.cartProducts
            }
        },
        methods: {
            checkout() {
                this.$store.dispatch('checkout')
            }
        },
    }
</script>

<style scoped>

</style>