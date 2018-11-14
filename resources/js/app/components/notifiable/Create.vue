<template>
    <v-container fluid fill-height>
        <v-layout>
            <v-flex>
                <form>
                    <v-flex xs12 sm12 d-flex>
                        <v-select
                                :items="models"
                                label="Model"
                                v-model="notifiable.model"
                                :error="error_messages.model == false"
                                :error-messages="error_messages.model"
                        ></v-select>
                    </v-flex>

                    <v-text-field
                            v-model="notifiable.message"
                            label="Message"
                            :error="error_messages.message == false"
                            :error-messages="error_messages.message"
                            required
                    ></v-text-field>

                    <v-btn @click.prevent="submit()" color="primary">submit</v-btn>
                </form>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        data () {
            return {
                fillable: ['model', 'message'],
                notifiable: {},
                models: [],
                error_messages: []
            }
        },
        mounted() {
            this.getModels()
        },
        methods: {
            getModels() {
                axios.get('api/notifiables/models').then(response => {
                    this.models = response.data.models
                })
            },
            submit(){
                let data = fillForm(this.fillable, this.notifiable)
                axios.post(`api/notifiables`, data).then(response => {
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