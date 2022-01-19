<template>
    <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto" v-show="isOpen">
        <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/4 mx-2 sm:mx-auto my-10 opacity-100">
            <div
                    class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 p-4"
                    v-show="isOpen"
            >
                <header class="flex items-center justify-between">
                    <h2 v-if="isEdit" class="font-semibold text-2xl">Edita la categoria: {{ category.name }}</h2>
                    <h2 v-else class="font-semibold text-2xl">Crea una nueva categoria</h2>
                    <button class="py-2 px-4 rounded hover:bg-red-400 hover:text-white" @click="isOpen = false">
                        <i class="fas fa-times"></i>
                    </button>
                </header>
                <main class="mt-4">
                    <div class="flex flex-col mb-6">
                        <label for="name" class="block mb-2 uppercase font-semibold text-xs text-gray-700">Nombre</label>
                        <input v-model="form.name" name="name" id="name" type="text" class="rounded border border-gray-200 p-2 focus:outline-blue-400">
                        <span class="mt-2 text-sm text-red-500" v-text="form.errors.name"></span>
                    </div>
                    <div class="flex flex-col mb-6">
                        <label for="translation" class="block mb-2 uppercase font-semibold text-xs text-gray-700">Traducción</label>
                        <input v-model="form.translation" name="translation" id="translation" type="text" class="rounded border border-gray-200 p-2 focus:outline-blue-400">
                        <span class="mt-2 text-sm text-red-500" v-text="form.errors.translation"></span>
                    </div>
                    <div class="flex flex-col mb-6">
                        <label for="image" class="block mb-2 uppercase font-semibold text-xs text-gray-700">Imagen</label>
                        <input @input="form.image = $event.target.files[0]" name="image" id="image" type="file" class="rounded border border-gray-200 p-2 focus:outline-blue-400">
                        <span class="mt-2 text-sm text-red-500" v-text="form.errors.image"></span>
                    </div>
                </main>
                <footer class="flex flex-row-reverse mt-8">
                    <button
                            class="bg-blue-400 font-semibold text-white p-2 w-32 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300"
                            @click="save"
                            :disabled="form.processing"
                    >
                        Guardar
                    </button>
                </footer>
            </div>
        </div>
    </div>
</template>

<script>
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
                this.form.slug = this.form.name.toLowerCase()

                if (this.isEdit) {
                    await this.form.post('/categories/update', {
                        onSuccess: () => this.isOpen = false,
                    })
                } else {
                    await this.form.post('/categories/')
                }
            },

            open() {
                this.isOpen = true
            }
        }
    }
</script>