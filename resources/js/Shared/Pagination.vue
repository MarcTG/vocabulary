<template>
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between mt-6">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium" v-text="info.from"></span>
                    to
                    <span class="font-medium" v-text="info.to"></span>
                    of
                    <span class="font-medium" v-text="info.total"></span>
                    results
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <Link
                            class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                            :class="{
                                'z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium' : link.active,
                                'rounded-l-lg': index === 0,
                                'rounded-r-lg': index === links.length-1

                                }"
                            v-for="(link, index) in links"
                            :href="link.url"
                            v-html="link.label"
                    ></Link>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Pagination",
        props: {
            info: Object,
            links: Object
        }
    }
</script>

