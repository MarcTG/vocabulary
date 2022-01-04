<template>
    <Link
            class="text-black hover:underline"
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