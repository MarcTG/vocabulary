<template>
    <div>
        <div class="flex justify-between">

            <h1 class="text-3xl">Categorias</h1>

            <div class="flex">
                <button class="text-black px-4 py-2 bg-blue-400 hover:bg-blue-600 hover:shadow-lg shadow mr-4 rounded-lg text-white" @click="isOpen = true">Crear Categoria</button>
                <div class="relative">
                    <input v-on:input="search()" v-model="searchData" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-blue-400" type="text" placeholder="Search ...">
                    <button class="-ml-12 z-20 px-4 py-2 text-blue-400 text-lg hover:text-blue-600"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-5 gap-4 mt-8">
            <div @click="$inertia.visit(`/categories/${category.slug}`)" v-for="category in categories.data" class="bg-gray-100 rounded-lg shadow overflow-hidden cursor-pointer">
                <img src="https://picsum.photos/300/200?random=1" alt="">
                <div class="p-4 flex justify-between">
                    <h2 class="text-xl">{{ category.name }}</h2>
                    <p class="self-center">Worte: {{ category.wordsCount }}</p>
                </div>
            </div>
        </div>

        <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto" v-show="isOpen">
            <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/4 mx-2 sm:mx-auto my-10 opacity-100">
                <div
                        class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 p-4"
                        v-show="isOpen"
                >
                    <header class="flex items-center justify-between">
                        <h2 class="font-semibold text-2xl">Crea una nueva categoria</h2>
                        <button class="py-2 px-4 rounded hover:bg-red-400 hover:text-white" @click="isOpen = false">
                            <i class="fas fa-times"></i>
                        </button>
                    </header>
                    <main class="mt-4">
                        <div class="flex flex-col mb-2">
                            <label for="name" class="block mb-2 uppercase font-semibold text-xs text-gray-700">Nombre</label>
                            <input v-model="form.name" name="name" id="name" type="text" class="rounded border border-gray-200 p-2 focus:outline-blue-400">
                        </div>
                        <div class="flex flex-col mb-2">
                            <label for="translation" class="block mb-2 uppercase font-semibold text-xs text-gray-700">Traducción</label>
                            <input v-model="form.translation" name="translation" id="translation" type="text" class="rounded border border-gray-200 p-2 focus:outline-blue-400">
                        </div>
                    </main>
                    <footer class="flex flex-row-reverse mt-8">
                        <button
                                class="bg-blue-400 font-semibold text-white p-2 w-32 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300"
                                @click="createCategory"
                                :disabled="form.processing"
                        >
                            Guardar
                        </button>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import debounce from "lodash/debounce"
    export default {
        name: "Index",
        props: {
            categories: Object,
            filters: Object
        },
        data() {
            return {
                searchData: this.filters.search,
                isOpen: false,
                form: this.$inertia.form({
                    name: null,
                    translation: null,
                    slug: null,
                })
            }
        },
        methods: {
            search: debounce(function() {
                this.$inertia.get('/categories', {search: this.searchData}, {preserveState:true, replace:true})
            }, 500),

            createCategory() {
                this.form.slug = this.form.name.toLowerCase()
                this.form.post('/categories/')
            },
        }
    }
</script>

<style scoped>

</style>