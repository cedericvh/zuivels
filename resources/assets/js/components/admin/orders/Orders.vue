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
                            <th>Address</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tr v-for="order in orders" :key="order.id">
                            <td>{{ order.id }}</td>
                            <td>{{ order.email }}</td>
                            <td>
                                <router-link class="btn btn-link" :to="`/admin/products/${product.id}/edit`" v-for="product in order.products" :key="product.id">
                                    {{ product.title }} ({{ product.pivot.quantity }})
                                </router-link>
                            </td>
                            <td>{{ order.rejected ? 'Yes' : 'No' }}</td>
                            <td>
                                {{ order.country }}, {{ order.city }}, {{ order.address1 }} {{ order.address2 }}
                            </td>
                            <td>{{ order.date }}</td>
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
            Echo.channel('orders')
            .listen('OrderCreated', (e) => {
                if (e.created) this.fetchData()
            })
            this.fetchData()
        }
    }
</script>

<style scoped>

</style>