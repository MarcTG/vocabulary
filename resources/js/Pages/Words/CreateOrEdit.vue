<template>
    <Modal>

    </Modal>
</template>

<script>
    import Modal from '../../Shared/Modal'
    export default {
        name: "CreateOrEdit",
        data() {
            return {
                form: this.$inertia.form({
                    'id': null,
                    'singular': null,
                    'plural': null,
                    'translation': null,
                    'example': null,
                    'type': null
                }),
            }
        },
        components: {
            Modal
        }
    }
</script>

<style scoped>

</style>