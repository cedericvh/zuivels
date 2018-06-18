<template>
    <header class="site-header clearfix">
        <div class="container d-flex justify-content-sm-between align-items-end">
            <a href="/" class="logo col-md-4 col-sm-12">
                <img src="/images/logo@2x.png" alt="logo">
            </a>

            <div class="col-md-8 col-sm-12">
                <div class="top d-none d-md-block">
                    <a href="#">
                        <a v-if="user" @click.prevent="logout">Uitloggen</a>
                        <router-link v-else to="/login">Inloggen</router-link>
                    </a> -
                    <router-link v-if="user" to="/winkelmandje">winkelwagen</router-link>
                    <router-link v-else to="/register">Register</router-link>
                </div>
                <nav class="navbar navbar-expand-lg navbar-light justify-content-end">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="nav navbar-nav justify-content-end">
                            <li class="nav-item">
                                <router-link class="nav-link" to="/">Home</router-link>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/#werking">werking</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/#regios">regio’s</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/#geschiedenis">geschiedenis</a>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" to="/aanbod">aanbod</router-link>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/#contact">contact</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
</template>

<script>
    export default {
        name: "AppHeader",
        computed: {
            user() {
                return this.$store.getters.user
            }
        },
        methods: {
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
    header.site-header .navbar-nav .nav-link.router-link-exact-active:after {
        background-color: #c1e473;
    }
</style>