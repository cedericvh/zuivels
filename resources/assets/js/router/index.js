import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'

import Login from '../components/auth/Login.vue'
import Register from '../components/auth/Register.vue'
import UserProfile from '../components/auth/UserProfile.vue'

import Home from '../components/client/Home.vue'
import ProductList from '../components/client/ProductList.vue'
import ProductListGuest from '../components/client/ProductListGuest.vue'
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
import Shippingrounds from '../components/admin/shippingrounds/Shippingrounds.vue'
import ShippingroundsCreate from '../components/admin/shippingrounds/ShippingroundsCreate.vue'
import ShippingroundsEdit from '../components/admin/shippingrounds/ShippingroundsEdit.vue'
import Orders from '../components/admin/orders/Orders.vue'
import ResetPassword from '../components/auth/ResetPassword'
import ResetPasswordForm from '../components/auth/ResetPasswordForm'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        // Auth
        { path: '/login', component: Login, meta: { guest: true } },
        { path: '/register', component: Register, meta: { guest: true } },
        { path: '/password/reset', component: ResetPassword, meta: { guest: true } },
        { path: '/password/reset/:token', component: ResetPasswordForm, meta: { guest: true } },
        { path: '/userprofile/:id/edit', name: 'userprofile', component: UserProfile, meta: { auth: true }, props: true },

        // Client
        { path: '/', name: 'home', component: Home },
        { path: '/aanbod-gast', name: 'aanbod-gast', component: ProductListGuest, meta: { guest: true } },
        { path: '/aanbod', name: 'aanbod', component: ProductList, meta: { auth: true } },
        { path: '/winkelmandje', name: 'winkelmandje', component: Cart, meta: { auth: true } },
        { path: '/checkout', name: 'checkout', component: Checkout, meta: { auth: true, productsInBag: true } },

        // Admin
        { path: '/admin', component: AdminHome, meta: { admin: true } },
        { path: '/admin/products', component: AdminProducts, meta: { admin: true } },
        { path: '/admin/products/create', component: ProductsCreate, meta: { admin: true } },
        { path: '/admin/products/:id/edit', component: ProductsEdit, meta: { admin: true }, props: true },
        { path: '/admin/categories', component: Categories, meta: { admin: true } },
        { path: '/admin/users', component: Users, meta: { admin: true } },
        { path: '/admin/users/create', component: UsersCreate, meta: { admin: true } },
        { path: '/admin/users/:id/edit', component: UsersEdit, meta: { admin: true }, props: true },
        { path: '/admin/shippingrounds', component: Shippingrounds, meta: { admin: true } },
        { path: '/admin/shippingrounds/create', component: ShippingroundsCreate, meta: { admin: true } },
        { path: '/admin/shippingrounds/:id/edit', component: ShippingroundsEdit, meta: { admin: true }, props: true },
        { path: '/admin/orders', component: Orders, meta: { admin: true } },
        { path: '/admin/products/import', component: ProductsImport, meta: { admin: true } }
    ],
    scrollBehavior (to, from, savedPosition) {
        //https://router.vuejs.org/guide/advanced/scroll-behavior.html
        if (to.hash) {
            return { selector: to.hash }
        } else if (savedPosition) {
            return savedPosition
        } else {
            return { x: 0, y: 0 }
        }
    }
})

router.beforeResolve((to, from, next) => {
    store.dispatch('fetchData').then(user => {
        if (to.meta.auth && !user) {
            next({ path: '/login' })
        } else if (to.meta.guest && user) {
            next({ path: '/' })
        } else if (to.meta.admin && (!user || !user.is_admin)) {
            next({ path: '/' })
        } else if (!to.meta.admin && user && user.is_admin) {
            next({ path: '/admin' })
        } else if (to.meta.productsInBag && !store.state.cart.added.length) {
            next({ path: '/aanbod' })
        } else {
            next()
        }
    })
})

export default router
