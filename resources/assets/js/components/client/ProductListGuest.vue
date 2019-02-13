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
                <div id="filters" class="row filters">
                    <div class="side col-md-6 order-md-1 mb-4">
                        <search-select></search-select>
                    </div>
                    <div class="side col-md-6 order-md-2 mb-4">
                        <tree-select></tree-select>
                    </div>
                </div>
                <div class="row">
                    <div class="main col-md-12 order-md-2">
                        <p>Andere merken, soorten of verpakkingen van producten steeds verkrijgbaar <a href="#contact">op aanvraag</a>.</p>
                        <alert></alert>
                        <products-guest></products-guest>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import ProductsGuest from './ProductsGuest.vue'
    import SearchSelect from './SearchSelect.vue'
    import TreeSelect from './TreeSelect.vue'

    export default {
        name: "ProductListGuest",
        components: {ProductsGuest, TreeSelect, SearchSelect}
    }
    
    
    window.onscroll = function() {
    
      let filters = document.getElementById('filters');
    
      if(filters){
      if (window.pageYOffset > 360 ) {
          filters.classList.add("sticky-top");
      } else {
          filters.classList.remove("sticky-top");
      }
    }
    
    }
    
</script>

<style scoped>

  .sticky-top {


    top:160px;    
    background-color:#f5f8fa;

  }



</style>