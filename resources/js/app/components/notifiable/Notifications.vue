<template>
    <div>
        <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition">
            <v-btn icon large flat slot="activator">
                <v-badge overlap color="error"><span slot="badge" dark small>{{ count }}</span>
                    <v-icon style="font-size: 30px">notifications_none</v-icon>
                </v-badge>
            </v-btn>

            <v-flex xs12>
                <v-card>
                    <v-list subheader>
                        <v-subheader>Recent notifications</v-subheader>

                        <v-divider></v-divider>
                        <v-list-tile v-for="item in notifications"
                                     :key="item.title"
                                     avatar
                                     @click="">
                            <v-list-tile-action>
                                <v-icon :color="item.active ? 'teal' : 'grey'">chat_bubble</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-sub-title class="text-sm-left">You have new notification</v-list-tile-sub-title>
                            </v-list-tile-content>
                            <v-list-tile-content>
                                <v-list-tile-title class="caption">{{ item.created_at | ago }}</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list>

                    <v-divider></v-divider>
                </v-card>
            </v-flex>
        </v-menu>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                snackbar: false,
                mode: '',
                notifications: [],
                count: null
            }
        },
        computed: {
            user(){
                return this.$store.getters['user/getUser'];
            }
        },
        mounted() {
            this.getNotifications()
        },
        methods: {
            getNotifications() {
                axios.get('api/notifications').then(response => {
                    this.count = response.data.notifications.length
                    this.notifications = response.data.notifications
                })
            }
        }
    }
</script>