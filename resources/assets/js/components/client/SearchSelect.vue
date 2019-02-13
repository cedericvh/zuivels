<template>
    <div>
        <h3>Filter naam</h3>
        <input
          type="text"
          placeholder="Zoek product"
          v-model="searchselect"
          @change="addSearchString(searchselect)"
        >
        <button @click="addSearchString(searchselect)">Filter</button>
    </div>
</template>

<script>
    

    export default {
        name: "SearchSelect",
        components: {
            
        },
        data() {
            return {
                searchselect: [],
                
            }
        },
        methods: {
        
          addSearchString() {
                
                this.$store.dispatch('getSearchedProducts', this.searchselect.toLowerCase())
            },

        },
        created() {
            
        }
    }
</script>

<style scoped>

</style>