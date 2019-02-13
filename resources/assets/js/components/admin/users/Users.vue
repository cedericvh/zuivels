<template>
    <div>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i>Users management</h1>
                <p>Pas gebruikers aan</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Users management</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="tile">
                    <h3 class="tile-title">Users
                        <router-link to="/admin/users/create" class="btn btn-link float-right">Create User</router-link>
                    </h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th class="text-right">Actions</th>
                        </tr>
                        </thead>
                        <tr v-for="user in users" :key="user.id" :class="{'table-danger': !user.approved}">
                            <td>{{ user.id }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <a href="" @click.prevent="approve(user.id)" class="btn btn-sm btn-link" v-if="!user.approved">Approve</a>
                                    <a href="" @click.prevent="destroy(user.id)" class="btn btn-sm btn-link">Delete</a>
                                    <router-link :to="`/admin/users/${user.id}/edit`" class="btn btn-sm btn-link">Edit</router-link>
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
        name: "Users",
        data() {
            return {
                users: []
            }
        },
        methods: {
            fetchData() {
                axios.get('/users')
                .then(response => this.users = response.data.users)
            },
            destroy(id) {
                axios.delete(`/users/${id}`)
                .then(response => {
                    if (response.data.success) this.fetchData()
                })
            },
            approve(id) {
                axios.get(`/users/${id}/approve`)
                .then(response => {
                    if (response.data.success) {
                        this.fetchData()
                    }
                })
            }
        },
        created() {
            this.fetchData()
        }
    }
</script>

<style scoped>

</style>