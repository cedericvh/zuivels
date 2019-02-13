<template>
    <div class="productlist">
        <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6 text-right">
               
            </div>
        </div>
        <div class="row" v-for="i in Math.ceil(products.length / 3)">
            <div v-for="(product, index) in products.slice((i - 1) * 4, i * 4)" class="item col-lg-3 col-md-6 col-sm-6 mb-3 product text-center">
                <div class="h-100">                   
                    <div class="d-flex">
                      <img v-if="product.image" :src="product.image" :alt="product.title"  class="justify-content-center align-self-center" @error="imgUrlAlt">
                      
                    </div> 
                    <p>{{product.title}}</p>
                    <div class="add-to-cart guest">
                        <div class="right float-right">
                            <a class="button" @click="redirect()">In winkelwagen</a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductsGuest",
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
            redirect() {
            
            this.$router.push({path: '/login'})
            
            },            
            imgUrlAlt(event) {
                event.target.src = "/images/placeholder.jpg"
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