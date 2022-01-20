<template>
    <Link
            class="text-white hover:underline font-semibold text-lg"
            :class="{'font-bold underline': active}"
    >
        <slot></slot>
    </Link>
</template>

<script>
    export default {
        name: "NavLink",
        props: {
            active: Boolean
        },
    }
</script>

<style scoped>

</style>