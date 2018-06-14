<template>
    <li class="list-group-item">
        <div :class="{bold: isFolder}" @dblclick="changeType" class="cursor-pointer">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group" v-if="isEdit">
                        <input type="text" v-model="model.title" class="form-control"/>
                    </div>
                    <h6 v-else>{{ model.title }}</h6>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-sm btn-link float-right" @click="toggle" v-if="isFolder">
                        <i class="fa" :class="open ? 'fa-angle-down' : 'fa-angle-left'"></i>
                    </button>
                    <button class="btn btn-sm btn-link float-right" @click="edit">
                        <i class="fa" :class="isEdit ? 'fa-check' : 'fa-edit'"></i>
                    </button>
                    <button class="btn btn-sm btn-link float-right" @click="addChild">
                        <i class="fa fa-plus"></i>
                    </button>
                    <button v-if="model.id !== 1" class="btn btn-sm btn-link float-right" @click="removed">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
        <draggable class="cursor-pointer list-group" v-show="open" v-if="isFolder" v-model="model.children" element="ul" :options="options" @sort="fireChange">
            <item @change="fireChange"
                  @removed="remove(index)"
                  v-for="(model, index) in model.children"
                  :key="index"
                  :model="model"
                  :sorting_id="index"
                  class="list-group-item"
            ></item>
        </draggable>
    </li>
</template>

<script>
    import Vue from 'vue'
    import Draggable from 'vuedraggable'

    export default {
        name: "Tree",
        components: {Draggable},
        props: {
            model: Object,
            sorting_id: Number
        },
        data() {
            return {
                open: true,
                isEdit: false,
                options: {
                    sort: true,
                    group: 'sorting'
                },
            }
        },
        computed: {
            isFolder() {
                return this.model.children && this.model.children.length
            }
        },
        methods: {
            fireChange() {
                this.$emit('change')
            },
            toggle() {
                if (this.isFolder) {
                    this.open = !this.open
                }
            },
            changeType() {
                if (!this.isFolder) {
                    Vue.set(this.model, 'children', [])
                    this.addChild()
                    this.open = true
                }
            },
            addChild() {
                this.model.children.push({
                    title: 'New Category'
                })
                this.fireChange()
            },
            edit() {
                this.isEdit = !this.isEdit
                if (!this.isEdit) this.fireChange()
            },
            remove(index) {
                this.model.children.splice(index, 1)
                this.fireChange()
            },
            removed() {
                this.$emit('removed')
            }
        },
        updated() {
            this.model.sorting_id = this.sorting_id
        }
    }
</script>

<style scoped>
    .cursor-pointer {
        cursor: pointer;
    }
</style>