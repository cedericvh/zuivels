import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'

import Login from '../components/auth/Login.vue'
import Register from '../components/auth/Register.vue'

import Home from '../components/client/Home.vue'
import ProductList from '../components/client/ProductList.vue'
import Cart from '../components/client/Cart.vue'
import Checkout from '../components/client/Checkout.vue'

import AdminHome from '../components/admin/Home.vue'
import AdminProducts from '../components/admin/products/Products.vue'
import ProductsEdit from '../components/admin/products/ProductsEdit.vue'
import ProductsCreate from '../components/admin/products/ProductsCreate.vue'
import ProductsImport from '../components/admin/products/ProductsImport.vue'
import Categories from '../components/admin/categories/Categories.vue'
import Users from '../components/admin/users/Users.vue'
import UsersCreate from '../components/admin/users/UsersCreate.vue'
import UsersEdit from '../components/admin/users/UsersEdit.vue'
import Orders from '../components/admin/orders/Orders.vue'

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
        {path: '/checkout', component: Checkout, meta: {auth: true}},

        // Admin
        {path: '/admin', component: AdminHome, meta: {admin: true}},
        {path: '/admin/products', component: AdminProducts, meta: {admin: true}},
        {path: '/admin/products/create', component: ProductsCreate, meta: {admin: true}},
        {path: '/admin/products/:id/edit', component: ProductsEdit, meta: {admin: true}, props: true},
        {path: '/admin/categories', component: Categories, meta: {admin: true}},
        {path: '/admin/users', component: Users, meta: {admin: true}},
        {path: '/admin/users/create', component: UsersCreate, meta: {admin: true}},
        {path: '/admin/users/:id/edit', component: UsersEdit, meta: {admin: true}, props: true},
        {path: '/admin/orders', component: Orders, meta: {admin: true}},
        {path: '/admin/products/import', component: ProductsImport, meta: {admin: true}},
    ],
    // linkExactActiveClass: 'active'
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
