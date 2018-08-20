<template>
    <aside class="app-sidebar">
        <div class="app-sidebar__user">
            <img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
            <div>
                <p class="app-sidebar__user-name">Winkelbeheerder</p>
                <p class="app-sidebar__user-designation"></p>
            </div>
        </div>
        <ul class="app-menu">
            <li v-for="item in menuItems"
                :class="{ treeview: item.children, 'is-expanded': item.children && item.id === activeMenuId }"
                @click="activeMenuId = activeMenuId === item.id ? null : item.id">
                <router-link class="app-menu__item" :to="item.path">
                    <i class="app-menu__icon fa" :class="item.icon"></i>
                    <span class="app-menu__label">{{ item.name }}</span>
                    <i v-if="item.children" class="treeview-indicator fa fa-angle-right"></i>
                </router-link>
                <ul class="treeview-menu" v-if="item.children">
                    <li v-for="child in item.children">
                        <router-link class="treeview-item" :to="child.path">
                            <i class="icon fa" :class="child.icon"></i> {{ child.name }}
                        </router-link>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</template>

<script>
    export default {
        name: "SideBar",
        data() {
            return {
                activeMenuId: null,
                menuItems: [
                    {
                        id: 1,
                        name: 'Dashboard',
                        icon: 'fa-dashboard',
                        path: '/admin'
                    },
                    {
                        id: 2,
                        icon: 'fa-th-list',
                        name: 'Producten',
                        path: '',
                        children: [
                            {
                                id: 1,
                                icon: 'fa-circle-o',
                                name: 'Producten aanpassen',
                                path: '/admin/products',
                            }, {
                                id: 2,
                                icon: 'fa-circle-o',
                                name: 'Categorieën aanpassen',
                                path: '/admin/categories',
                            }
                        ]
                    },
                    {
                        id: 3,
                        name: 'Users',
                        icon: 'fa-user',
                        path: '/admin/users'
                    },
                    {
                        id: 4,
                        name: 'Orders',
                        icon: 'fa-cart-arrow-down',
                        path: '/admin/orders'
                    }
                ]
            }
        }
    }
</script>

<style scoped>

</style>