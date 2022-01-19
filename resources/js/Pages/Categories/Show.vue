<template>
    <div>
        <div class="mb-6 flex flex-col">
            <div class="flex justify-between">
                <h1 class="text-5xl text-center mb-6">Categoria: {{category.name}} - {{category.translation}}</h1>
                <div class="">
                    <button @click="this.$refs.create.open()" class="px-6 py-3 rounded-lg rounded-r-none bg-gray-200 text-gray-600 inline hover:bg-blue-600 hover:text-white"><i class="fas fa-edit"></i></button>
                    <button @click="remove" class="px-6 py-3 rounded-lg rounded-l-none bg-gray-200 text-gray-6000 inline hover:bg-red-600 hover:text-white"><i class="fas fa-trash"></i></button>
                </div>
            </div>
            <img :src="category.image" alt="" class="mx-auto" style="max-width: 900px">
        </div>
        <div class="mb-12">
            <h2 class="text-2xl mb-4">Palabras Agregadas</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-400">
                    <tr>
                        <th scope="col" class="px-6 py-6 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Singular
                        </th>
                        <th scope="col" class="px-6 py-6 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Plural
                        </th>
                        <th scope="col" class="px-6 py-6 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Traducción
                        </th>

                        <th scope="col" class="relative px-6 py-6">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-50 divide-y divide-gray-200">
                    <tr v-for="word in words">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ word.singular }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ word.plural }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ word.translation }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button @click="removeWord(word.categoryWordId)" :disabled="form.processing" class="text-red-500 hover:text-red-700 hover:underline">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <h2 class="text-2xl mb-4">Agrega nuevas Palabras</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Singular
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Plural
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Traducción
                        </th>

                        <th scope="col" class="relative px-6 py-3 float-right">
                            <input v-on:input="search()" v-model="searchData" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-blue-400" type="text" placeholder="Search ...">
                            <button class="-ml-12 z-20 px-4 py-2 text-blue-400 text-lg hover:text-blue-600"><i class="fas fa-search"></i></button>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-50 divide-y divide-gray-200">
                    <tr v-for="word in newWords.data">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ word.singular }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ word.plural }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ word.translation }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button @click="addWord(word.id)" :disabled="form.processing" class="text-green-500 hover:text-green-700 hover:underline">Agragar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <Edit ref="create" :category="category"></Edit>

    </div>
</template>

<script>
    import debounce from "lodash/debounce"
    import Edit from "./CreateOrEdit"
    export default {
        name: "Show",
        props: {
            category: Object,
            words: Object,
            newWords: Object,
        },
        data() {
            return {
                searchData: '',
                form: this.$inertia.form({
                    'category_id': null,
                    'word_id': null,
                }),
            }
        },
        methods: {
            search: debounce(function() {
                this.$inertia.get(`/categories/${this.category.slug}`, {search: this.searchData}, {preserveState:true, replace:true, preserveScroll: true,})
            }, 500),

            addWord(wordId) {
                this.searchData = ''
                this.form.category_id = this.category.id
                this.form.word_id = wordId
                this.form.post(`/category/word`, {preserveState:true, replace:true, preserveScroll: true,})
            },

            removeWord(id) {
                this.form.delete(`/category/word/${id}`, {preserveState:true, replace:true, preserveScroll: true,})
            },

            remove() {
                this.$inertia.delete('/categories', {
                    data: {
                        'id': this.category.id
                    }
                })
            }
        },
        components: {
            Edit
        }
    }
</script>

<style scoped>

</style>