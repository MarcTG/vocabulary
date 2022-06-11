<template>
    <div>
        <div class="mb-6 flex flex-col">
            <div class="flex justify-between mb-6">
                <h1 class="text-5xl text-center text-slate-500 font-medium">Categoria: {{category.name}} - {{category.translation}}</h1>
                <div class="group-btn">
                    <button @click="$refs.create.open()" class="btn-primary-light text-xl"><i class="fas fa-edit"></i></button>
                    <button @click="$refs.alert.open()" class="btn-danger-light text-xl"><i class="fas fa-trash"></i></button>
                </div>
                <v-modal ref="alert">
                    <template v-slot:header>
                        <div class="flex flex-col">
                            <span class="text-9xl text-rose-400 mx-auto"><i class="fas fa-exclamation-triangle"></i></span>
                            <h2 class="text-3xl text-center text-slate-600 mt-4">¿Estás seguro?</h2>
                        </div>
                    </template>

                    <p class="text-slate-600 text-lg">La categoria se eliminara pero las palabras dentro de la categoria, no.</p>

                    <template v-slot:footer>
                        <div class="flex justify-end">
                            <button @click="$refs.alert.close()" class="btn btn-primary mr-4">Cancelar</button>
                            <button @click="remove" :disabled="categoryForm.processing" class="btn btn-danger-light">Eliminar</button>
                        </div>
                    </template>
                </v-modal>
            </div>
            <img :src="category.image" alt="" class="mx-auto" style="max-width: 900px">
        </div>

        <h2 class="text-2xl mb-4 text-slate-500">Palabras Agregadas</h2>

        <div class="shadow-lg rounded-lg overflow-hidden mb-16">
            <div class="grid grid-cols-4 bg-indigo-400 px-6 text-left text-sm font-medium text-white uppercase h-16 items-center">
                <span>Singular</span>
                <span>Plural</span>
                <span>Traducción</span>
                <span class="sr-only">Delete</span>
            </div>

            <div class="grid grid-cols-4 bg-slate-50 px-6 py-4 text-sm text-slate-600 text-left hover:bg-indigo-50" v-for="word in words">
                <span>{{ word.singular }}</span>
                <span>{{ word.plural }}</span>
                <span>{{ word.translation }}</span>
                <div class="text-right font-medium">
                    <button @click="removeWord(word.categoryWordId)" :disabled="form.processing" class="text-rose-500 hover:text-rose-700 hover:underline">Remover</button>
                </div>
            </div>
        </div>

        <h2 class="text-2xl mb-4 text-slate-500">Agrega nuevas palabras</h2>

        <div class="shadow-lg rounded-lg overflow-hidden">
            <div class="grid grid-cols-4 bg-indigo-400 px-6 text-left text-sm font-medium text-white uppercase h-16 items-center">
                <span>Singular</span>
                <span>Plural</span>
                <span>Traducción</span>
                <div class="relative flex justify-end">
                    <input v-on:input="search()" v-model="searchData" class="border border-gray-300 rounded-lg focus:outline-blue-400 text-base text-slate-600 py-2 px-2" type="text" placeholder="Search ...">
                    <button class="-ml-12 z-20 px-4 py-2 text-blue-400 text-lg hover:text-blue-600"><i class="fas fa-search"></i></button>
                </div>
            </div>

            <div class="grid grid-cols-4 bg-slate-50 px-6 py-4 text-sm text-slate-600 text-left hover:bg-indigo-50" v-for="word in newWords.data">
                <span>{{ word.singular }}</span>
                <span>{{ word.plural }}</span>
                <span>{{ word.translation }}</span>
                <div class="text-right font-medium">
                    <button @click="addWord(word.id)" :disabled="form.processing" class="text-green-500 hover:text-green-700 hover:underline">Agragar</button>
                </div>
            </div>
        </div>

        <Edit ref="create" :category="category"></Edit>
    </div>
</template>

<script>
    import debounce from "lodash/debounce"
    import Modal from "../../Shared/Modal"
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
                    'id': null,
                    'category_id': this.category.id,
                    'word_id': null,
                }),
                categoryForm: this.$inertia.form({
                    'id': this.category.id
                })
            }
        },
        methods: {
            search: debounce(function() {
                this.$inertia.get(`/categories/${this.category.slug}`, {search: this.searchData}, {preserveState:true, replace:true, preserveScroll: true,})
            }, 500),

            addWord(wordId) {
                this.searchData = ''
                this.form.word_id = wordId
                this.form.post(`/category/word`, {
                    preserveState:true, preserveScroll: true,
                    onSuccess: () => {
                        this.emitter.emit('showNotification', { message: "Palabra agregada satisfactoriamente", type: 0})
                    },
                    onError: () => {
                        this.emitter.emit('showNotification', { message: "Hubo un problema al agregar la palabra.", type: 1})
                    },
                })
            },

            removeWord(id) {
                this.form.id = id
                this.form.delete(`/category/word/`, {
                    onSuccess: () => {
                        this.emitter.emit('showNotification', { message: "Palabra removida satisfactoriamente", type: 0})
                    },
                    onError: () => {
                        this.emitter.emit('showNotification', { message: "Hubo un problema al remover la palabra.", type: 1})
                    },
                    preserveState:true,
                    preserveScroll: true,
                })
            },

            remove() {
                this.categoryForm.delete('/categories', {
                    onSuccess: (page) => {
                        this.emitter.emit('showNotification', { message: "Categoria eliminada correctamente.", type: 0})
                    },
                    onError: (errors) => {
                        this.emitter.emit('showNotification', { message: "Hubo un problema al eliminar la categoria.", type: 1})
                    }
                })
            }
        },
        components: {
            Edit,
            'v-modal' : Modal
        }
    }
</script>

<style scoped>

</style>