<template>
    <v-data-table :headers="headers" :items="images" class="elevation-1 font-weight-medium login">
        <template v-slot:top>
            <v-toolbar flat color="#04153B10" class="mb-12">
                <v-toolbar-title>Liste des images</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="500px">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                            Ajouter une image
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
                                        <v-img :src="editedItem.src"></v-img>
                                    </v-col>
                                    <v-col cols="12" sm="12" md="12">
                                        <v-text-field v-model="editedItem.src" label="Url"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="12" md="12">
                                        <v-text-field v-model="editedItem.name" label="Nom"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="12" md="12">
                                        <v-text-field v-model="editedItem.description" label="Description"></v-text-field>
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

        <!-- image -->
        <template v-slot:item.src="{ item }">
            <v-avatar class="profile" color="grey" size="100" tile>
                <v-img :src="item.src"></v-img>
            </v-avatar>
        </template>
        <!--  -->

        <!-- online -->
        <template v-slot:item.online="{ item }">
            <v-switch v-model="item.online" @change="updateOnline(item.id)" inset></v-switch>
        </template>

        <template v-slot:no-data>
            <v-btn color="primary" @click="initialize">
                Reset
            </v-btn>
        </template>
    </v-data-table>
</template>

<script>

import apiImage from "../../services/axios/image";
import {  mapActions } from "vuex";

export default {
    data: () => ({
        dialog: false,
        dialogDelete: false,
        headers: [
            {
                text: 'Image',
                align: 'start',
                sortable: false,
                value: 'src',
            },
            { text: 'Nom', value: 'name' },
            { text: 'Description', value: 'description' },
            { text: 'Online', value: 'online' },
            { text: 'Actions', value: 'actions', sortable: false },
        ],
        images: [],
        editedIndex: -1,
        editedItem: {
            id:0,
            name: '',
            description: '',
            src:'',
            online:false,
        },
        defaultItem: {
            id:0,
            name: '',
            description: '',
            src:'',
            online:false,
        },
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'Ajouter image' : 'Modifier image'
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
            apiImage.getAllImages().then(res => {
                this.images = res.data.data
            })
        },

        editItem(item) {
            this.editedIndex = this.images.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem(item) {
            this.editedIndex = this.images.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm() {
            apiImage.deleteImage(this.images[this.editedIndex].id).then(res => {
                this.images.splice(this.editedIndex, 1)
                this.openSnack({
                        message:"image supprim??",
                        color:"success"
                })
                this.closeDelete()
            })
        },

        updateOnline(id) {
            apiImage.updateImageOnline(id).then(res =>{
                this.openSnack({
                        message:"image mis ?? jour",
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

                apiImage.updateImage(this.images[this.editedIndex].id, {
                    name:this.editedItem.name,
                    description:this.editedItem.description,
                    url:this.editedItem.src
                }).then(res => {
                    Object.assign(this.images[this.editedIndex], this.editedItem)
                    this.openSnack({
                        message:"image modifi??e",
                        color:"success"
                    })
                    this.close()
                }).catch(err => console.log(err.toString()))

            } else {
                apiImage.storeNewImages({
                    name:this.editedItem.name,
                    description:this.editedItem.description,
                    url:this.editedItem.src
                }).then(res => {
                    this.images.push(res.data.data)
                    this.openSnack({
                        message:"image cr????",
                        color:"success"
                    })
                    this.close()
                }).catch(err => console.log(err.toString()))

            }
        },
    },
}
</script>
