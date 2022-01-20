<template>
    <transition name="fade">
        <div v-show="isOpen" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <transition name="scale">
                    <div v-show="isOpen"  class="p-6 inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <header class="mb-6">
                            <slot name="header"></slot>
                        </header>

                        <main class="mb-6">
                            <slot></slot>
                        </main>

                        <footer>
                            <slot name="footer"></slot>
                        </footer>
                    </div>
                </transition>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        name: "Modal",
        props: {
            hasIcon: false
        },
        data() {
            return {
                isOpen: false
            }
        },
        methods: {
            open() {
                this.isOpen = true
            },
            close() {
                this.isOpen = false
            }
        }
    }
</script>

<style scoped>
    .fade-enter-active {
        transition: opacity 0.2s ease-out;
    }
    .fade-leave-active {
        transition: opacity 0.2s ease-in;
    }

    .fade-enter-from,
    .fade-leave-to {
        opacity: 0;
    }

    .scale-enter-active {
        transition: all 0.3s ease-out;
    }
    .scale-leave-active {
        transition: all 0.3s ease-in;
    }

    .scale-enter-from,
    .scale-leave-to {
        --tw-scale-x: .95;
        --tw-scale-y: .95;
    }
</style>