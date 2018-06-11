<template>
    <div>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i>Orders management</h1>
                <p>Adjust the Orders</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Orders management</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="tile">
                    <h3 class="tile-title">Orders
                    </h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Bestelling</th>
                            <th>Rejected</th>
                            <th>Dategetorder</th>
                            <th>Date</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tr v-for="order in orders" :key="order.id">
                            <td>{{ order.id }}</td>
                            <td>{{ order.email }}</td>
                            <td>{{ order.bestelling }}</td>
                            <td>{{ order.rejected }}</td>
                            <td>{{ order.dategetorder }}</td>
                            <td>{{ order.date }}</td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <a href="" @click.prevent="destroy(order.id)" class="btn btn-sm btn-link">Delete</a>
                                    <router-link :to="`/admin/orders/${order.id}/edit`" class="btn btn-sm btn-link">Edit</router-link>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Orders",
        data() {
            return {
                orders: []
            }
        },
        methods: {
            fetchData() {
                axios.get('/orders')
                .then(response => this.orders = response.data.orders)
            },
            destroy(id) {
                axios.delete(`/orders/${id}`)
                .then(response => {
                    if (response.data.success) this.fetchData()
                })
            }
        },
        mounted() {
            Echo.private('orders.1')
            .listen('OrderUpdated', (e) => {
                console.log(e)
            })
            this.fetchData()
        }
    }
</script>

<style scoped>

</style>