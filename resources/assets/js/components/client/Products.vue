<template>
    <div class="productlist">
        <div class="row">
            <div class="col-sm-6">
                <button class="btn btn-primary" @click="checkoutWithLatest">
                    Laatste order inladen en aanpassen
                </button>
            </div>
            <div class="col-sm-6 text-right">
                <span>Uw winkelmandje bevat {{cartProductsQuantity}} producten - <router-link to="/winkelmandje">Naar de winkelmand</router-link></span>
            </div>
        </div>
        <div class="row" v-for="i in Math.ceil(products.length / 3)">
            <div v-for="(product, index) in products.slice((i - 1) * 4, i * 4)" class="item col-lg-3 col-md-6 col-sm-6 mb-3 product text-center">
                <div class="h-100">
                    <div class="d-flex productcontainer">
                      <img v-if="product.image" :src="product.image" :alt="product.title"  class="justify-content-center align-self-center" @error="imgUrlAlt">   
                      <div v-if="product.toorder" class="bestelproduct">Bestelproduct</div>
                    </div>  
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
            imgUrlAlt(event) {
                event.target.src = "/images/placeholder.jpg"
            },            
            checkoutWithLatest() {
                axios.get('/orders/latest')
                .then(response => {
                    this.$store.dispatch('setCart', response.data.order.products.map(item => {
                        return {
                            id: item.pivot.product_id,
                            quantity: item.pivot.quantity,
                        }
                    }))
                    this.$router.push({path: '/winkelmandje'})
                })
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