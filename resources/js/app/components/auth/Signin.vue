<template>
    <v-container fluid fill-height class="signin-container">
        <v-layout align-center justify-center>
            <v-flex xs12 sm10 md8 lg6>

                <v-card class="elevation-12">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title>Sign In</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>

                    <v-card-text>
                        <v-form>
                            <v-text-field label="email"
                                          required
                                          v-model="data.username"
                                          :error="errors.username == false"
                                          :error-messages="errors.username"
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
                        </v-form>
                    </v-card-text>

                    <v-card-actions>
                        <v-btn color="primary" @click="submit()" small>Sign In</v-btn>
                        <v-btn color="primary" to="/signup" small>create an account</v-btn>
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
                fillable: ['username', 'password', 'client_id', 'client_secret', 'grant_type'],
                data: {
                    client_id: 2,
                    client_secret: 'jZ7ppdRzQwXZCfvuXkJ9U0cr7WQSUbFo7cdVMAlA',
                    grant_type: 'password'
                },
                errors: []
            }
        },

        methods: {
            ...mapActions({
                signIn: 'signIn'
            }),
            submit() {
                let data = fillForm(this.fillable, this.data)

                this.signIn(data).then(response => {
                    this.$router.push('/')
                }).catch(err => {
                    this.errors = err.response.data.errors;
                    console.log(this.errors)
                })
            }
        }
    }
</script>
