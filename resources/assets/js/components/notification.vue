<template>
    <div class="notification-wrap">
        <div v-for="notification in notifications" class="notification" :class="notification.type">
            <div class="icon"></div>
            <div class="notification-content">{{notification.content}}</div>
            <button class="close" v-on:click="closeNotification(notification)">&times;</button>
        </div>
    </div>
</template>

<script>

    import ClawsNotifications from '../plugins/notifications';

    export default {

        data() {
            return {
                notifications: []
            }
        },

        beforeMount() {
            ClawsNotifications.event.$on('add', (notification) => {
                this.notifications.push(notification);
            });

            ClawsNotifications.event.$on('clear', (notification) => {
                this.notifications = [];
            });
        },

        methods: {
            closeNotification(notification) {
                this.notifications.pop(this.notifications.findIndex(n => n == notification));
            }
        }
    }
</script>
