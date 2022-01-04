<template>
    <div>
        <div class="flex justify-between">

            <h1 class="text-3xl">Categorias</h1>

            <div class="flex">
                <Link class="text-black px-4 py-2 bg-blue-400 hover:bg-blue-600 hover:shadow-lg shadow mr-4 rounded-lg text-white" href="/categories/create">Crear Categoria</Link>
                <div class="relative">
                    <input v-on:input="search()" v-model="searchData" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-blue-400" type="text" placeholder="Search ...">
                    <button class="-ml-12 z-20 px-4 py-2 text-blue-400 text-lg hover:text-blue-600"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-5 gap-4 mt-8">
            <div @click="$inertia.visit('/')" v-for="category in categories.data" class="bg-gray-100 rounded-lg shadow overflow-hidden cursor-pointer">
                <img src="https://picsum.photos/300/200?random=1" alt="">
                <div class="p-4 flex justify-between">
                    <h2 class="text-xl">{{ category.name }}</h2>
                    <p class="self-center">Worte: {{ category.wordsCount }}</p>
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
                searchData: this.filters.search
            }
        },
        methods: {
            search: debounce(function (e) {
                this.$inertia.get('/categories', { search: this.searchData }, { preserveState:true, replace:true })
            }, 500)
        }
    }
</script>

<style scoped>

</style>