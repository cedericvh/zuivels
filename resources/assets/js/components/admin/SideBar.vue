<template>
    <aside class="app-sidebar">
        <div class="app-sidebar__user">
            <img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
            <div>
                <p class="app-sidebar__user-name">John Doe</p>
                <p class="app-sidebar__user-designation">Frontend Developer</p>
            </div>
        </div>
        <ul class="app-menu">
            <li v-for="item in menuItems"
                :class="{ treeview: item.childs, 'is-expanded': item.childs && item.id === activeMenuId }"
                @click="activeMenuId = activeMenuId === item.id ? null : item.id">
                <router-link class="app-menu__item" :to="item.path">
                    <i class="app-menu__icon fa" :class="item.icon"></i>
                    <span class="app-menu__label">{{ item.name }}</span>
                    <i v-if="item.childs" class="treeview-indicator fa fa-angle-right"></i>
                </router-link>
                <ul class="treeview-menu" v-if="item.childs">
                    <li v-for="child in item.childs">
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
                        childs: [
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
                    }
                ]
            }
        }
    }
</script>

<style scoped>

</style>