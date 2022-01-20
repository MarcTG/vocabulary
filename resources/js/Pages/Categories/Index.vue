<template>
    <div>
        <div class="flex justify-between">

            <h1 class="text-5xl text-slate-500">Categorias</h1>

            <div class="flex">
                <button class="btn-lg btn-primary mr-4" @click="() => { this.$refs.create.open() }">Crear Categoria</button>
                <div class="relative">
                    <input v-on:input="search()" v-model="searchData" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-blue-400" type="text" placeholder="Busca categorias...">
                    <button class="-ml-12 z-20 px-4 py-2 text-cyan-500 text-lg hover:text-cyan-700"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-5 gap-4 my-8">
            <div @click="$inertia.visit(`/categories/${category.slug}`)" v-for="category in categories.data" class="bg-gray-100 rounded-lg shadow overflow-hidden cursor-pointer">
                <img v-if="category.image" :src="category.image">
                <img v-else src="https://picsum.photos/300/200?random=1" alt="">
                <div class="p-4 flex justify-between">
                    <h2 class="text-xl text-slate-600">{{ category.name }}</h2>
                    <p class="self-center text-slate-500">Palabras: {{ category.wordsCount }}</p>
                </div>
            </div>
        </div>

        <Pagination :info="{ 'from': categories.from, 'to': categories.to, 'total': categories.total }" :links="categories.links"></Pagination>

        <Create ref="create" :isOpen="isOpen"></Create>
    </div>
</template>

<script>
    import debounce from "lodash/debounce"
    import Pagination from '../../Shared/Pagination'
    import Create from './CreateOrEdit';
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
            }
        },
        methods: {
            search: debounce(function() {
                this.$inertia.get('/categories', {search: this.searchData}, {preserveState:true, replace:true})
            }, 500),
        },
        components: {Pagination, Create}
    }
</script>

<style scoped>

</style>