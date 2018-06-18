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
        <br>
        <section class="catalog">
            <div class="container">
                <div class="row">
                    <div class="side col-md-3 order-md-1 mb-4">
                        <tree-select></tree-select>
                    </div>
                    <div class="main col-md-9 order-md-2">
                        <alert></alert>
                        <products></products>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import Products from './Products.vue'
    import TreeSelect from './TreeSelect.vue'

    export default {
        name: "ProductList",
        components: {Products, TreeSelect}
    }
</script>

<style scoped>

</style>