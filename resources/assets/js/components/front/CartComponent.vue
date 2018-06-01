<template>
    <div class="cart">
        <h1 class="title">Winkelmandje</h1>
        <p v-show="!cartProducts.length">
            <i>Jouw winkelmandje is leeg !</i>
            Voeg snel iets toe !
        <p>{{ message }}</p>
        </p>
        <table class="table is-striped" v-show="cartProducts.length">
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
            <button v-show="cartProducts.length" class='button is-primary' @click='checkout'>Uw bestelling plaatsen</button>
            of <a href="/aanbod">verder winkelen</a></p>
    </div>
</template>

<script>

    export default {
        computed: {

            cartProducts() {

                return this.$store.getters.cartProducts

            },

            itemsInCart() {
                let cart = this.$store.getters.cartProducts
                return cart.reduce((accum, item) => accum + item.quantity, 0)
            },

            message() {

                return this.$store.getters.message

            },

        },
        methods: {
            checkout() {
                this.$store.dispatch('checkout')
            }
        },

        mounted() {
            setTimeout(() => {
                this.$forceUpdate()
            }, 100)
        },

    }
</script>