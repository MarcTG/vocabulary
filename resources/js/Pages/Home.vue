<template>
    <div>
        <v-modal ref="modal" title="Eliminar Categoria" message="Estas seguro que quieres eliminar esta categoria?"></v-modal>
        <button @click="openModal" >abrir</button>
    </div>
</template>

<script>
    import Modal from '../Shared/Modal'
    export default {
        props: ['categories'],
        name: "Home",
        methods: {
            openModal() {
                this.$refs.modal.open()
            }
        },
        components: {
            'v-modal' : Modal
        }
    }
</script>

<style scoped>

</style>