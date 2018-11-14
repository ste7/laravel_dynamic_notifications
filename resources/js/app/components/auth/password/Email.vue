<template>
    <v-container fluid fill-height>
        <v-layout align-center justify-center>
            <v-flex xs12 sm10 md8 lg6>

                <v-card class="elevation-12">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title>Send Email</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>

                    <v-card-text>
                        <v-form>
                            <v-text-field label="email"
                                          required
                                          v-model="data.email"
                                          :error="errors.email == false"
                                          :error-messages="errors.email"
                                          @keyup.enter="submit()">
                            </v-text-field>
                        </v-form>
                    </v-card-text>

                    <v-card-actions>
                        <v-btn color="primary" @click.prevent="submit()" small>Send Email</v-btn>
                    </v-card-actions>
                </v-card>

                <div class="text-xs-center">
                    <v-dialog v-model="modal" width="500">

                        <v-card>
                            <v-card-title class="headline grey lighten-2" primary-title>Message</v-card-title>

                            <v-card-text>{{ message }}</v-card-text>

                            <v-divider></v-divider>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="primary" flat @click="modal = false">Ok</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </div>

            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import { mapActions } from 'vuex'

    export default {
        data() {
            return {
                fillable: ['email'],
                data: {},
                errors: [],
                message: null,
                modal: false
            }
        },

        methods: {
            ...mapActions({
                createPassword: 'createPassword'
            }),
            submit() {
                let data = fillForm(this.fillable, this.data)

                this.createPassword(data).then(response => {
                    this.modal = true
                    this.message = response.data.message
                }).catch(err => {
                    this.errors = err.response.data.errors
                })
            }
        }
    }
</script>