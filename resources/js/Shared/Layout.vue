<template>
    <Head>
        <title>My App</title>
    </Head>
    <section class="p-6 bg-cyan-500">
        <header class="flex justify-between container mx-auto">
            <div class="flex items-center">
                <h1 class="text-white text-lg font-semibold">My App</h1>
                <!--<p class="text-sm ml-4">Welcome back, {{ username }}</p>-->
            </div>
            <Nav></Nav>
        </header>
    </section>

    <section class="container mx-auto mt-6 mx-auto">
        <slot/>
    </section>

    <Notification></Notification>
</template>

<script>
    import Nav from './Nav'
    import Notification from '../Shared/Notification'
    export default {
        name: "Layout",
        components: { Nav, Notification },
        computed: {
/*            username() {
                return this.$page.props.auth.user.username
            }*/
        },

    }
</script>

<style scoped>

</style>