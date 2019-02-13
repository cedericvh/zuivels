<template>
    <div>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i>Ronde management</h1>
                <p>Pas rondes aan</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Ronde management</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="tile">
                    <h3 class="tile-title">Rondes
                        <router-link to="/admin/shippingrounds/create" class="btn btn-link float-right">Maak Ronde</router-link>
                    </h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Naam</th>                            
                            <th class="text-right">Acties</th>
                        </tr>
                        </thead>
                        <draggable class="cursor-pointer" v-model="shippingrounds" element="tbody" :options="options" @sort="sorted">
                        <tr v-for="shippinground in shippingrounds" :key="shippinground.id">
                            <td>{{ shippinground.id }}</td>
                            <td>{{ shippinground.name }}</td>
                            
                            <td class="text-right">
                                <div class="btn-group">
                                    
                                    <a href="" @click.prevent="destroy(shippinground.id)" class="btn btn-sm btn-link">Delete</a>
                                    <router-link :to="`/admin/shippingrounds/${shippinground.id}/edit`" class="btn btn-sm btn-link">Edit</router-link>
                                </div>
                            </td>
                        </tr>
                        </draggable>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import Draggable from 'vuedraggable'

    export default {
        name: "Shippingrounds",
        data() {
            return {
                options: {
                    sort: true,
                    group: 'sorting'
                },
                
                curPage: 1
            }
        },
        components: {

            Draggable
        },
        methods: {

            destroy(id) {
                axios.delete(`/shippingrounds/${id}`)
                .then(response => {
                    if (response.data.success) this.fetchData()
                })
            },
            sorted(e) {
                axios.get(`/shippingrounds/sort/${this.shippingrounds[e.oldIndex].sorting_id}/${this.shippingrounds[e.newIndex].sorting_id}`)
                .then(response => {
                    if(response.data.success) this.$store.dispatch('getAllShippingrounds')
                }).catch(response => console.log(response.data))
            },            
        },
        computed: {
            shippingrounds: {
                get() {
                    return this.$store.getters.allShippingrounds
                },
                set(value) {
                    this.$store.dispatch('sort', value)
                }
            },
        },        
        created() {
            
            this.$store.dispatch('getAllShippingrounds')
        }
    }
</script>

<style scoped>
    .cursor-pointer {
        cursor: pointer;
    }
</style>