<template>
    <div>
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Categorieën bekijken</h1>
                <p>Pas de categorieën aan</p>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Categorieën aanpassen</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="tile">
                    <h3 class="tile-title">Categorieën
                        <router-link to="/admin/categories/create" class="btn btn-link float-right">Categorie aanmaken</router-link>
                    </h3>
                    <category-draggable :parent="0"></category-draggable>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CategoryDraggable from './CategoryDraggable.vue'
    export default {
        name: "Categories",
        components: {CategoryDraggable}
    }
</script>

<style scoped>

</style>