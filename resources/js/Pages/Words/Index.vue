<template>
    <div>
        <h1 class="text-5xl text-slate-500 mb-8">Vocabulario</h1>

        <div class="shadow-lg rounded-lg overflow-hidden">
            <div class="grid grid-cols-4 bg-indigo-400 px-6 text-left text-sm font-medium text-white uppercase h-16 items-center">
                <span>Singular</span>
                <span>Plural</span>
                <span>Traducción</span>
                <div class="relative flex justify-end">
<!--                    <input v-on:input="search()" v-model="searchData" class="border border-gray-300 rounded-lg focus:outline-blue-400 text-base text-slate-600 py-2 px-2" type="text" placeholder="Search ...">
                    <button class="-ml-12 z-20 px-4 py-2 text-blue-400 text-lg hover:text-blue-600"><i class="fas fa-search"></i></button>-->
                </div>
            </div>

            <div class="grid grid-cols-4 bg-slate-50 px-6 py-4 text-sm text-slate-600 text-left hover:bg-indigo-50" v-for="word in words.data">
                <span>{{ word.singular }}</span>
                <span>{{ word.plural }}</span>
                <span>{{ word.translation }}</span>
                <div class="text-right font-medium">
                    <button @click="remove(word.id)" :disabled="form.processing" class="text-rose-500 hover:text-rose-700 hover:underline  mr-3">Eliminar</button>
                    <!--<button @click="edit(word.id)" :disabled="newWord.processing" class="text-indigo-500 hover:text-indigo-700 hover:underline">Editar</button>-->
                </div>
            </div>
        </div>

    </div>

</template>

<script>

    export default {
        name: "Index",
        props: {
            words: Object
        },
        data() {
            return {
                form: this.$inertia.form({
                   'id': null
                }),
            }
        },

        methods: {
            add() {
                this.newWord.post('/words/')
            },

            remove(id) {
                this.form.id = id
                this.form.delete('/words',  {
                    onSuccess: () => {
                        this.emitter.emit('showNotification', { message: "Palabra eliminada satisfactoriamente", type: 0})
                    },
                    onError: () => {
                        this.emitter.emit('showNotification', { message: "Hubo un problema al eliminar la palabra.", type: 1})
                    },
                    preserveState:true,
                    preserveScroll: true,
                })
            },

            edit() {
                this.form.post('/words/update')
            }
        },


    }
</script>
