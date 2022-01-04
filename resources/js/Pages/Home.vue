<template>
    <div>
        <div v-for="category in categories" v-text="category.name">

        </div>
    </div>
</template>

<script>
    export default {
        props: ['categories'],
        name: "Home"
    }
</script>

<style scoped>

</style>