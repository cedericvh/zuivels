<template>
    <div>
        <button
                type="button"
                class="btn"
                @click="showModal"
        >
            Naar jouw winkelmandje
        </button>

        <front-cart
                v-show="isModalVisible"
                @close="closeModal"
        />
    </div>
</template>
<script>

    export default {
        name: 'app',

        data() {
            return {
                isModalVisible: false,
            }
        },
        methods: {
            showModal() {
                this.isModalVisible = true
            },
            closeModal() {
                this.isModalVisible = false
            }
        },
    }
</script>