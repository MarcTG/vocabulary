<template>
    <div>

            <button @click="pushNot" class="btn btn-danger-light">test</button>
        <button @click="pushNot2" class="btn btn-danger-light">test 2</button>


    </div>
</template>

<script>
    import mitt from 'mitt'
    export default {
        props: ['categories'],
        name: "Home",
        data() {
            return {
                counter: 0
            }
        },
        methods: {
            pushNot() {
                this.emitter.emit("showNotification", {
                    message: `la categoria se guardo correctamente ${this.counter}`,
                    type: 0
                });
            },
            pushNot2() {

                this.emitter.emit("showNotification", {
                    message: `la categoria se guardo correctamente ${this.counter}`,
                    type: 1
                });
            }
        },

    }
</script>
