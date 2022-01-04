<template>
    <Head>
        <title>My App</title>
    </Head>
    <section class="p-6 bg-gray-200">
        <header class="flex justify-between">
            <div class="flex items-center">
                <h1 class="font-bold text-lg">My App</h1>
                <!--<p class="text-sm ml-4">Welcome back, {{ username }}</p>-->
            </div>
            <Nav></Nav>
        </header>
    </section>

    <section class="p-6 container mx-auto">
        <slot/>
    </section>
</template>

<script>
    import Nav from './Nav'

    export default {
        name: "Layout",
        components: { Nav },
        computed: {
/*            username() {
                return this.$page.props.auth.user.username
            }*/
        }
    }
</script>

<style scoped>

</style>