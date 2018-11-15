<template>
    <v-container fluid fill-height>
        <v-layout>
            <v-flex>
                <v-card>
                    <v-breadcrumbs divider="/">
                        <v-breadcrumbs-item to="/" :disabled="false">home</v-breadcrumbs-item>
                        <v-breadcrumbs-item to="/notifiables" :exact="true" :disabled="false">notifiables</v-breadcrumbs-item>
                        <v-breadcrumbs-item :disabled="true">edit</v-breadcrumbs-item>
                    </v-breadcrumbs>
                </v-card>

                <v-card class="fix-card">
                    <form>
                        <v-text-field
                                v-model="notifiable.model"
                                :error="error_messages.name == false"
                                :error-messages="error_messages.model"
                                label="Name"
                                required
                                disabled
                                readonly
                        ></v-text-field>

                        <v-text-field
                                v-model="notifiable.message"
                                label="Message"
                                required
                        ></v-text-field>

                        <v-btn @click.prevent="submit()" color="primary">submit</v-btn>
                    </form>
                </v-card>
            </v-flex>

            <v-fab-transition>
                <v-btn :color="'primary'" dark fab fixed bottom right to="/permissions/create">
                    <v-icon>playlist_add</v-icon>
                    <v-icon>close</v-icon>
                </v-btn>
            </v-fab-transition>
        </v-layout>
    </v-container>
</template>

<script>
    import swal from 'sweetalert2'

    export default {
        data () {
            return {
                fillable: ['model', 'message', 'on'],
                notifiable: {},
                error_messages: []
            }
        },
        mounted(){
            this.getNotifiable()
        },
        methods: {
            getNotifiable(){
                axios.get('api/notifiables/' + this.$route.params.id).then(response => {
                    this.notifiable = response.data.notifiable
                    console.log(this.notifiable)
                }).catch(e => {
                    console.log(e)
                    this.error = e.response.data.errors
                });
            },
            submit(){
                let data = fillForm(this.fillable, this.notifiable, 'PUT')
                axios.post(`api/notifiables/${this.notifiable.id}`, data).then(response => {
                    swal({
                        position: 'center',
                        type: 'success',
                        title: 'Success',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.error_messages = []
                    this.notifiable = response.data.notifiable
                }).catch( e => {
                    console.log(e.response.data)
                    this.error_messages = e.response.data.errors
                })
            }
        }
    }
</script>