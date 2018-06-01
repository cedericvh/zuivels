import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'

import Login from '../components/auth/Login.vue'
import Register from '../components/auth/Register.vue'

import Home from '../components/client/Home.vue'
import ProductList from '../components/client/ProductList.vue'
import Cart from '../components/client/Cart.vue'

import AdminHome from '../components/admin/Home.vue'
import AdminProducts from '../components/admin/products/Products.vue'
import ProductsEdit from '../components/admin/products/ProductsEdit.vue'
import ProductsCreate from '../components/admin/products/ProductsCreate.vue'
import Categories from '../components/admin/categories/Categories.vue'

Vue.use(VueRouter)

const router = new VueRouter({
    routes: [
        // Auth
        {path: '/login', component: Login, meta: {guest: true}},
        {path: '/register', component: Register, meta: {guest: true}},

        // Client
        {path: '/', component: Home},
        {path: '/aanbod', component: ProductList, meta: {auth: true}},
        {path: '/winkelmandje', component: Cart, meta: {auth: true}},

        // Admin
        {path: '/admin', component: AdminHome, meta: {admin: true}},
        {path: '/admin/products', component: AdminProducts, meta: {admin: true}},
        {path: '/admin/products/create', component: ProductsCreate, meta: {admin: true}},
        {path: '/admin/products/:id/edit', component: ProductsEdit, meta: {admin: true}, props: true},
        {path: '/admin/categories', component: Categories, meta: {admin: true}}
    ],
    linkExactActiveClass: 'active'
})

router.beforeResolve((to, from, next) => {
    let user = store.state.auth.user
    if (to.meta.auth && !user) {
        next({path: 'login'})
    } else if (to.meta.guest && user) {
        next({path: '/'})
    } else if (to.meta.admin && (!user || !user.is_admin)) {
        next({path: '/'})
    } else if (!to.meta.admin && user && user.is_admin) {
        next({path: '/admin'})
    } else {
        next()
    }
})

export default router
