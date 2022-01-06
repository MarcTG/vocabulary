<template>
    <div>
        <h1 class="text-3xl">Crea una nueva Categoria</h1>
        <div class="mt-8 grid grid-cols-2 gap-4">
            <div class="flex flex-col mb-2">
                <label for="nombre" class="block mb-2 uppercase font-semibold text-xs text-gray-700">Nombre</label>
                <input name="name" id="nombre" type="text" class="rounded border border-gray-200 px-2 py-4 focus:outline-blue-400">
            </div>
            <div class="flex flex-col mb-2">
                <label for="tranduccion" class="block mb-2 uppercase font-semibold text-xs text-gray-700">Traducción</label>
                <input name="translation" id="tranduccion" type="text" class="rounded border border-gray-200 px-2 py-4 focus:outline-blue-400">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Create",
        props: {
            words: Object
        }
    }
</script>

<style scoped>

</style>