<template>
    <header class="site-header clearfix">
        <div class="container d-flex justify-content-sm-between align-items-end">
            <a href="/" class="logo col-md-4 col-sm-12">
                <img src="/images/logo@2x.png" alt="logo">
            </a>

            <div class="col-md-8 col-sm-12">
                <div class="top d-none d-md-block">
                    
                    <router-link v-if="user" :to="`/userprofile/${user.id}/edit`">{{user.name}}</router-link>
                    <router-link v-else :to="`/aanbod-gast`">aanbod</router-link>
                    - 
                    <router-link v-if="user" :to="`/winkelmandje`">winkelwagen <span style="font-size:70%;">({{cartProductsQuantity}})</span></router-link>
                    <router-link v-else :to="`/register`">Registreer</router-link>
                    -
                    <a v-if="user" class="cursor" @click.prevent="logout">Uitloggen</a>
                    <router-link v-else :to="`/login`">Inloggen</router-link>
                    <span style="position:absolute;right:30px; height:20px; width:40px;"><router-link v-if="user" :to="`/winkelmandje`"><span style="font-size:100%;display:block;">{{cartProductsQuantity}}</span></router-link></span>
                </div>
                <nav class="navbar navbar-expand-lg navbar-light justify-content-end">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="nav navbar-nav justify-content-end">
                            <li class="nav-item">
                                <router-link class="nav-link" v-if="hashorurl" to="/#home" v-smooth-scroll="{ duration: 1000, offset: -50}">home</router-link>
                                <router-link class="nav-link" v-else to="#home" v-smooth-scroll="{ duration: 1000, offset: -50}">home</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" v-if="hashorurl" to="/#werking" v-smooth-scroll="{ duration: 1000, offset: -50}">werking</router-link>
                                <router-link class="nav-link" v-else to="#werking" v-smooth-scroll="{ duration: 1000, offset: -50}">werking</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" v-if="hashorurl" to="/#regios" v-smooth-scroll="{ duration: 1000, offset: -50}">regio's</router-link>
                                <router-link class="nav-link" v-else to="#regios" v-smooth-scroll="{ duration: 1000, offset: -50}">regio's</router-link>
                            </li>
                            <li class="nav-item">
                               
                                
                                <router-link class="nav-link" v-if="hashorurl" to="/#geschiedenis" v-smooth-scroll="{ duration: 1000, offset: -50}">geschiedenis</router-link>
                                <router-link class="nav-link" v-else to="#geschiedenis" v-smooth-scroll="{ duration: 1000, offset: -50}">geschiedenis</router-link>
                                
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" v-if="user" to="/aanbod">aanbod</router-link>
                                <router-link class="nav-link" v-else to="/aanbod-gast">aanbod</router-link>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#contact" v-smooth-scroll="{ duration: 1000, offset: -50}">contact</a>
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
            },
            cartProductsQuantity() {
                return this.$store.getters.cartProductsQuantity
            },
            hashorurl(){
                
                
                if(this.$route.path != "/"){
                
                return true;
                
                }
            
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
        },
        
    }
    
    
</script>

<style scoped>
    header.site-header .navbar-nav .nav-link.router-link-exact-active:after {
        background-color: #c1e473;
    }
    
    .cursor {
    
    cursor:pointer;
    
    }
 
    
</style>