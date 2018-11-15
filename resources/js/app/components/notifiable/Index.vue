<template>
    <v-container fluid fill-height>
        <v-layout>
            <v-flex>
                <v-card>
                    <v-breadcrumbs divider="/">
                        <v-breadcrumbs-item to="/" :disabled="false">home</v-breadcrumbs-item>
                        <v-breadcrumbs-item :disabled="true">notifiable</v-breadcrumbs-item>
                    </v-breadcrumbs>
                </v-card>

                <v-card class="m-20">
                    <v-data-table
                            :headers="headers"
                            :items="notifiables"
                            :loading="loading"
                            :rows-per-page-items=[50,25,10]
                            class="elevation-1">

                        <template slot="items" slot-scope="props">
                            <td>{{ props.item.id }}</td>
                            <td class="text-xs-left">{{ props.item.model }}</td>
                            <td class="text-xs-left">{{ props.item.created_at }}</td>


                            <td class="text-xs-right">
                                <v-btn small color="secondary" class="black--text" :to="'/notifiables/' + props.item.id + '/edit'">
                                    <v-icon>edit</v-icon>
                                </v-btn>
                                <v-btn small color="error" @click="destroy(props.item)">
                                    <v-icon>delete</v-icon>
                                </v-btn>
                            </td>
                        </template>
                    </v-data-table>
                </v-card>
            </v-flex>

            <v-fab-transition>
                <v-btn :color="'primary'" dark fab fixed bottom right to="/notifiables/create">
                    <v-icon>playlist_add</v-icon>
                </v-btn>
            </v-fab-transition>
        </v-layout>
    </v-container>
</template>

<script>
    import swal from 'sweetalert2';

    export default {
        data() {
            return {
                loading: true,
                pagination: {},
                notifiables: [],
                headers: [
                    {text: 'ID', value: 'id', sortable: true, value: 'id'},
                    {text: 'MODEL', align: 'left', sortable: true, value: 'model'},
                    {text: 'CREATED AT',sortable: false,  value: 'created_at'},
                    {text: 'ACTION',sortable: false, align: 'right', value: 'action'},
                ],
            }
        },
        computed: {
            user(){
                return this.$store.getters['user/getUser']
            },
        },
        mounted() {
            this.getNotifiables()
        },
        methods: {
            getNotifiables() {
                this.loading = true
                axios.get(`api/notifiables`).then(response => {
                    this.notifiables = response.data.notifiables
                    this.loading = false
                }).catch(e => {
                    console.log(e.response)
                    this.error = e.response.data.errors
                })
            }
        }
    }
</script>

<style scoped>
    .swal2-styled.swal2-confirm{
        border-radius: 0 !important;
    }
</style>
