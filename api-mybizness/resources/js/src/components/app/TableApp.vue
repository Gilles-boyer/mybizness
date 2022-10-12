<template>
    <v-data-table :headers="headers" :items="applications" class="elevation-1 font-weight-medium login">
        <template v-slot:top>
            <v-toolbar flat color="#04153B10" class="mb-12">
                <v-toolbar-title>Liste des applications</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="500px">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                            Ajouter une application
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="text-h5">{{ formTitle }}</span>
                        </v-card-title>

                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" sm="12" md="12">
                                        <v-text-field v-model="editedItem.name" label="Nom de l'application"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="12" md="12">
                                        <v-text-field v-model="editedItem.host" label="host"></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="close">
                                Cancel
                            </v-btn>
                            <v-btn color="blue darken-1" text @click="save">
                                Save
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="dialogDelete" max-width="500px">
                    <v-card>
                        <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                            <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-toolbar>
        </template>

        <!-- action -->
        <template v-slot:item.actions="{ item }">
            <v-icon small class="mr-2" @click="editItem(item)">
                mdi-pencil
            </v-icon>
            <v-icon small @click="deleteItem(item)">
                mdi-delete
            </v-icon>
        </template>
        <!--  -->


        <!-- online -->
        <template v-slot:item.activate="{ item }">
            <v-switch v-model="item.activate" @change="updateOnline(item.id)" inset></v-switch>
        </template>
                <!-- online -->
        <template v-slot:item.token="{ item }">
            <v-row style="max-width:600px">
                <v-col cols="12">
                    {{ item.token }}
                </v-col>
            </v-row>
        </template>

        <template v-slot:no-data>
            <v-btn color="primary" @click="initialize">
                Reset
            </v-btn>
        </template>
    </v-data-table>
</template>

<script>

import apiApp from "../../services/axios/application";
import {  mapActions } from "vuex";

export default {
    data: () => ({
        dialog: false,
        dialogDelete: false,
        headers: [
            {
                text: 'Application',
                align: 'start',
                sortable: false,
                value: 'name',
            },
            { text: 'Nom', value: 'host' },
            { text: 'Description', value: 'token' },
            { text: 'Activé', value: 'activate' },
            { text: 'Actions', value: 'actions', sortable: false },
        ],
        applications: [],
        editedIndex: -1,
        editedItem: {
            id:0,
            name: '',
            token: '',
            host:'',
            activate:false,
        },
        defaultItem: {
            id:0,
            name: '',
            token: '',
            host:'',
            activate:false,
        },
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'Ajouter application' : 'Modifier application'
        },
    },

    watch: {
        dialog(val) {
            val || this.close()
        },
        dialogDelete(val) {
            val || this.closeDelete()
        },
    },

    created() {
        this.initialize()
    },

    methods: {
        ...mapActions(['openSnack']),
        initialize() {
            apiApp.getAllApps().then(res => {
                this.applications = res.data.data
            })
        },

        editItem(item) {
            this.editedIndex = this.applications.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem(item) {
            this.editedIndex = this.applications.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm() {
            apiApp.deleteApp(this.applications[this.editedIndex].id).then(res => {
                this.applications.splice(this.editedIndex, 1)
                this.openSnack({
                        message:"application supprimé",
                        color:"success"
                })
                this.closeDelete()
            })
        },

        updateOnline(id) {
            apiApp.updateAppActivate(id).then(res =>{
                this.openSnack({
                        message:"application mis à jour",
                        color:"success"
                })
            }).catch(err => console.log(err.toString()))
        },

        close() {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        closeDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        save() {
            if (this.editedIndex > -1) {

                apiApp.updateApp(this.applications[this.editedIndex].id, {
                    name:this.editedItem.name,
                    host:this.editedItem.host,
                }).then(res => {
                    Object.assign(this.applications[this.editedIndex], res.data.data)
                    this.openSnack({
                        message:"application modifiée",
                        color:"success"
                    })
                    this.close()
                }).catch(err => console.log(err.toString()))

            } else {
                apiApp.storeNewApp({
                    name:this.editedItem.name,
                    host:this.editedItem.host,
                }).then(res => {
                    this.applications.push(res.data.data)
                    this.openSnack({
                        message:"application créé",
                        color:"success"
                    })
                    this.close()
                }).catch(err => console.log(err.toString()))

            }
        },
    },
}
</script>
