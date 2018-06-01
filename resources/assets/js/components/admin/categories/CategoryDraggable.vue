<template>
    <div>
        <div v-for="(list, index) in categories" class="v-col--auto">
            <div class="panel">
                <div class="panel__heading">
                    <h3>List {{list.title}}</h3>
                </div>
                <div class="panel__body">
                    <vddl-list class="panel__body--list"
                               :category="list.children"
                               :inserted="handleInserted"
                               :dragover="handleDragover"
                               :drop="handleDrop"
                               :horizontal="false">
                        <vddl-draggable class="panel__body--item" v-for="(item, index) in list.children" :key="item.id"
                                        :draggable="item.children"
                                        :list="list"
                                        :item="item"
                                        :index="index"
                                        :wrapper="item.children"
                                        effect-allowed="move">
                            {{item.title}}
                        </vddl-draggable>
                        <vddl-placeholder class="red">Custom placeholder</vddl-placeholder>
                    </vddl-list>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: 'CategoryDraggable',
        data() {
            return {
                "selected": null,
                "categories": []
            }
        },

        methods: {

            loadRootOptions() {

                axios.get('/cats')
                .then(response => this.categories = response.data.categories[1].children)
                .catch(e => this.errors.push(e))
            },

            selectedEvent: function (item) {
                this.selected = item
            },
            handleDragstart() {
                console.log(':v-draggable: dragstart')
            },
            handleDragend() {
                console.log(':v-draggable: dragend')
            },
            handleCanceled() {
                console.log(':v-draggable: canceled')
            },
            handleInserted() {
                console.log(':v-list: inserted')
            },
            handleDrop(data) {
                console.log(':v-list: drop')
                console.log(data)
                const {index, category, item} = data
                // change the id
                item.id = new Date().getTime()
                category.splice(index, 0, item)
            },
            handleMoved(item) {
                console.log(':v-draggable: moved')
                console.log(item)
                const {index, category} = item
                category.splice(index, 1)
            },
            handleDragover() {
                console.log(':v-list: handleDragover')
            },
        },

        mounted() {
            this.loadRootOptions()
        }
    }

</script>

<style>

    .simple .vddl-placeholder {
        line-height: @item-height;
        border-bottom: 1px solid #eee;
        font-size: 14px;
        padding-left: 15px;
    }

    .red {
        color: red;
    }
</style>