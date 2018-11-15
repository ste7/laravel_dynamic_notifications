<template>
    <v-app id="inspire">

        <side-bar v-if="signedIn"></side-bar>

        <v-content>
            <v-container>
                <router-view></router-view>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        computed: {
            ...mapGetters({
                signedIn: 'signedIn'
            })
        },

        updated() {
            Echo.channel('created')
                .notification((notification) => {
                    // this.snackbar = true
                    // this.notification = notification
                    // this.notification = 'You have new notification!'
                    console.log(notification)
                });
        }
    }
</script>