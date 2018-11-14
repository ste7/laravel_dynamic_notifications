<template>
    <v-container fluid fill-height>
        <v-layout align-center justify-center>
            <v-flex xs12 sm10 md8 lg6>

                <v-card class="elevation-12">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title>Reset Password</v-toolbar-title>
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
                            <v-text-field label="password"
                                          required
                                          type="password"
                                          v-model="data.password"
                                          :error="errors.password == false"
                                          :error-messages="errors.password"
                                          @keyup.enter="submit()">
                            </v-text-field>
                            <v-text-field label="confirm password"
                                          required
                                          type="password"
                                          v-model="data.password_confirmation"
                                          :error="errors.password_confirmation == false"
                                          :error-messages="errors.password_confirmation"
                                          @keyup.enter="submit()">
                            </v-text-field>
                        </v-form>
                    </v-card-text>

                    <v-card-actions>
                        <v-btn color="primary" @click.prevent="submit()" small>Reset Password</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import { mapActions } from 'vuex'

    export default {
        data() {
            return {
                fillable: ['email', 'password', 'password_confirmation'],
                data: {},
                errors: [],
                modal: false
            }
        },

        mounted() {
            this.data.token = this.$route.params.token
        },

        methods: {
            ...mapActions({
                resetPassword: 'resetPassword'
            }),
            submit() {
                let data = fillForm(this.fillable, this.data)

                this.resetPassword(data).then(response => {
                    this.message = response.data.message
                }).catch(err => {
                    this.errors = err.response.data.errors
                })
            }
        }
    }
</script>