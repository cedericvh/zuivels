<template>
    <div class="productlist">
        <div class="row">
            <div class="col-sm-12 text-right">
                <span>Uw winkelmandje bevat {{cartProductsQuantity}} producten - <router-link to="/winkelmandje">Naar de winkelmand</router-link></span>
            </div>
        </div>
        <div class="row" v-for="i in Math.ceil(products.length / 3)">
            <div v-for="(product, index) in products.slice((i - 1) * 3, i * 3)" class="item col-lg-4 col-md-6 col-sm-6 mb-4 product text-center">
                <div>
                    <img :src="'/storage/' + product.image " class="img-fluid" onError="this.src='/images/placeholder.jpg';"/>
                    <p>{{product.title}}</p>
                    <div class="add-to-cart">
                        <div class="left float-left">
                            <a class="val plus" @click="addToCart(product)">+</a>
                            <a class="val minus" @click="decreaseQty(product)">-</a>
                            <input readonly class="qty float-left" type="number" :value="countInCart(product.id)">
                        </div>
                        <div class="right float-right">
                            <a class="button" @click="addToCart(product)">In winkelwagen</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Products",
        computed: {
            products() {
                return this.$store.getters.filteredProducts
            },
            cartProductsQuantity() {
                return this.$store.getters.cartProductsQuantity
            },
            cartProducts() {
                return this.$store.getters.cartProducts
            }
        },
        methods: {
            addToCart(product) {
                this.$store.dispatch('addProductToCart', product)
            },
            decreaseQty(product) {
                this.$store.dispatch('decreaseItemQuantity', product)
            },
            countInCart(id) {
                let cartProduct = this.cartProducts.find(item => item.id === id)
                return cartProduct ? cartProduct.quantity : 0
            },
            order() {
                axios.post('orders', {})
            }
        },
        created() {
            this.$store.dispatch('getAllProducts')
        }
    }
</script>

<style scoped>
    .button {
        cursor: pointer;
    }
</style>