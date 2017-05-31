<template>
    <li class="dropdown" v-if="userNotificationCount">
        <a href="#" class="dropdown-toggle" v-bind:class="{ 'bg-danger': userUnreadNotifications }" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Messages <span class="badge">{{userNotificationCount}}</span> <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <template v-for="(notification, key) in userNotifications">
                <li role="separator" class="divider" v-if="key > 0">{{index}}</li>
                <li>
                    <a :href="'/posts/' + notification.post_id">
                        New comment by {{notification.user}} on your blog post:<br />
                        {{notification.post_title}}<br />
                        <em>{{notification.comment}}</em>
                    </a>
                </li>
            </template>
        </ul>
    </li>
</template>

<script>
    export default {
        data() {
            return {
                userUnreadNotifications: 0,
                userNotificationCount: 0,
                userNotifications: [],
            }
        },
        mounted() {
            axios.get('/api/user/notifications').then(data => {
                this.userNotificationCount = data.data.notification_count;
                this.userUnreadNotifications = data.data.unread_notification_count;
                this.userNotifications = data.data.notifications;
            });
        }
    }
</script>
