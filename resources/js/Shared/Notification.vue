<template>
    <div class="mr-6 fixed top-20 right-0 w-80 z-20">
        <transition-group name="fade" tag="div"  class="w-full">
            <div v-for="notification in notifications" :key="notification.key" class="rounded-lg shadow-xl p-4 mt-4 text-lg flex" :class="notification.style">
                <span v-if="notification.type === 0" class="text-3xl text-emerald-400 mr-2 self-center">
                    <i class="fas fa-check-circle"></i>
                </span>
                <span v-else class="text-3xl text-rose-400 mr-2 self-center">
                    <i class="fas fa-exclamation-triangle"></i>
                </span>
                <span class="leading-tight self-center">{{ notification.message }}</span>
            </div>
        </transition-group>
    </div>
</template>

<script>
    export default {
        name: "Notification",
        created() {
            this.emitter.on('showNotification', (data) => {
                this.notifications.unshift({
                    message: data.message,
                    style: data.type === 0 ? this.type.success : this.type.danger,
                    type: data.type,
                    key: (new Date()).getTime()
                })
                setTimeout(() => {
                    this.notifications.pop()
                }, 3000);
            })
        },

        data() {
            return {
                type: {
                    success: 'bg-emerald-100 text-emerald-700',
                    danger: 'bg-rose-100 text-rose-600',
                },
                notifications: [],
                activeClass: '',
            }
        },
        methods: {
            showNotification(data) {
                this.message = data.message
                this.activeClass = data.type === 0 ? this.type.success : this.type.danger
            }
        }
    }
</script>

<style scoped>
    .fade-enter-active {
        transition: all 0.2s ease-out;
    }
    .fade-leave-active {
        transition: all 0.2s ease-in;
    }

    .fade-enter-from {
        opacity: 0;
        transform: translateY(-30px);
    }
    .fade-leave-to {
        opacity: 0;
        transform: translateY(30px);
    }
</style>