<template>
    <v-container fluid fill-height>
        <v-layout align-center justify-center>
            <v-flex xs12 sm10 md8 lg6>

                <v-card class="elevation-12">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title>Sign Up</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>

                    <v-card-text>
                        <v-form>
                            <v-text-field label="name"
                                          required
                                          v-model="data.name"
                                          :error="errors.name == false"
                                          :error-messages="errors.name"
                                          @keyup.enter="submit()">
                            </v-text-field>
                            <v-text-field label="email"
                                          required
                                          v-model="data.email"
                                          :error="errors.email == false"
                                          :error-messages="errors.email"
                                          @keyup.enter="submit()">
                            </v-text-field>
                            <v-text-field label="password"
                                          required
                                          v-model="data.password"
                                          type="password"
                                          :error="errors.password == false"
                                          :error-messages="errors.password"
                                          @keyup.enter="submit()">
                            </v-text-field>
                            <v-text-field label="confirm password"
                                          required
                                          v-model="data.password_confirmation"
                                          type="password"
                                          :error="errors.password_confirmation == false"
                                          :error-messages="errors.password_confirmation"
                                          @keyup.enter="submit()">
                            </v-text-field>
                        </v-form>
                    </v-card-text>

                    <v-card-actions>
                        <v-btn color="primary" @click.prevent="submit()" small>Sign Up</v-btn>
                        <v-btn color="primary" to="/signin" small>already have an account?</v-btn>
                        <v-btn to="/email/send" small>reset password</v-btn>
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
                fillable: ['name', 'email', 'password', 'password_confirmation'],
                data: {},
                errors: []
            }
        },

        methods: {
            ...mapActions({
                signUp: 'signUp'
            }),
            submit() {
                let data = fillForm(this.fillable, this.data)

                this.signUp(data).catch(err => {
                    this.errors = err.response.data.errors;
                })
            }
        }
    }
</script>