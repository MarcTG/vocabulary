<template>
    <nav>
        <ul class="flex space-x-6">
            <li>
                <NavLink href="/" :active="$page.component === 'Home'">Home</NavLink>
            </li>
            <li>
                <NavLink href="/categories" :active="$page.component === 'Categories'">Categorias</NavLink>
            </li>
            <li>
                <NavLink href="/words" :active="$page.component === 'Words'">Palabras</NavLink>
            </li>
        </ul>
    </nav>
</template>

<script>
    import NavLink from './NavLink'
    export default {
        name: "Nav",
        components: {
            NavLink
        }
    }
</script>
