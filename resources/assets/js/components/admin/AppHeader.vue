<template>
    <header class="app-header">
        <router-link class="app-header__logo" to="/admin">Zuivelhandel Els</router-link>
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar" @click="toggleSidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">

            <!-- User Menu-->
            <li class="dropdown">
                <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">

                    <li><a class="dropdown-item" href="" @click.prevent="logout"><i class="fa fa-sign-out fa-lg"></i> Uitloggen</a>
                    </li>
                </ul>
            </li>
        </ul>
    </header>
</template>

<script>
    export default {
        name: "AppHeader",
        methods: {
            toggleSidebar() {
                document.body.classList.toggle('sidenav-toggled')
            },
            logout() {
                axios.get('/logout').then(response => {
                    if (response.data.success) {
                        this.$store.dispatch('destroyUser')
                        this.$store.dispatch('destroyAccessToken')
                        this.$router.push({path: '/'})
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>