<template>
    <Modal ref="modal">
        <template v-slot:header>
            <h2  class="font-semibold text-2xl text-slate-500 text-center">
                <span v-if="isEdit">Edita la categoria: {{ category.name }}</span>
                <span v-else>Crea una nueva categoria</span>
            </h2>
        </template>

        <div class="flex flex-col mb-6">
            <label for="name" class="block mb-2 uppercase font-semibold text-xs text-slate-500">Nombre</label>
            <input v-model="form.name" name="name" id="name" type="text" class="rounded border border-slate-200 p-2 focus:outline-blue-400">
            <span class="mt-2 text-sm text-red-500" v-text="form.errors.name"></span>
        </div>
        <div class="flex flex-col mb-6">
            <label for="translation" class="block mb-2 uppercase font-semibold text-xs text-slate-500">Traducción</label>
            <input v-model="form.translation" name="translation" id="translation" type="text" class="rounded border border-slate-200 p-2 focus:outline-blue-400">
            <span class="mt-2 text-sm text-red-500" v-text="form.errors.translation"></span>
        </div>
        <div class="flex flex-col">
            <label for="image" class="block mb-2 uppercase font-semibold text-xs text-slate-500">Imagen</label>
            <input @input="form.image = $event.target.files[0]" name="image" id="image" type="file" class="rounded border border-slate-200 p-2 focus:outline-blue-400">
            <span class="mt-2 text-sm text-red-500" v-text="form.errors.image"></span>
        </div>

        <template v-slot:footer>
            <div class="flex justify-end">
                <button
                        class="btn btn-danger-light mr-4"
                        @click="$refs.modal.close()"
                >
                    Cerrar
                </button>
                <button
                        class="btn btn-primary"
                        @click="save"
                        :disabled="form.processing"
                >
                    Guardar
                </button>
            </div>
        </template>
    </Modal>
</template>

<script>
    import Modal from '../../Shared/Modal'
    export default {
        name: "CreateOrEdit",

        props: {
            category: Object
        },

        mounted() {
            if (this.category != null) {
                this.isEdit = true
                this.form.id = this.category.id
                this.form.name = this.category.name
                this.form.translation = this.category.translation
            }
        },

        data() {
            return {
                form: this.$inertia.form({
                    id: null,
                    name: null,
                    translation: null,
                    slug: null,
                    image: null,
                }),
                isOpen: false,
                isEdit: false,
            }
        },

        methods: {
            async save() {
                this.form.slug = this.form.name != null ? this.form.name.toLowerCase() : ''

                if (this.isEdit) {
                    await this.form.post('/categories/update', {
                        onSuccess: () => this.$refs.modal.close(),
                    })
                } else {
                    await this.form.post('/categories/')
                }
            },

            open() {
                this.$refs.modal.open()
            }
        },

        components: {
            Modal
        }
    }
</script>