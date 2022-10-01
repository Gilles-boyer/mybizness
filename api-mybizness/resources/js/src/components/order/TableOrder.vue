<template>
    <v-data-table
      :headers="headers"
      :items="getOrders"
      sort-by="date_order"
      class="elevation-1 font-weight-medium login"
    >
      <template v-slot:top>
        <v-toolbar
          flat
          color="#04153B10"
        >
          <v-toolbar-title >Liste des commandes</v-toolbar-title>
          <v-divider
            class="mx-4"
            inset
            vertical
          ></v-divider>
          <v-spacer></v-spacer>
          <v-dialog
            v-model="dialog"
            max-width="500px"
          >
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                color="primary"
                dark
                class="mb-2 "
                v-bind="attrs"
                v-on="on"
              >
                Nouvelle commande
              </v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="text-h5">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-text-field
                        v-model="editedItem.name"
                        label="Dessert name"
                      ></v-text-field>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-text-field
                        v-model="editedItem.calories"
                        label="Calories"
                      ></v-text-field>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-text-field
                        v-model="editedItem.fat"
                        label="Fat (g)"
                      ></v-text-field>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-text-field
                        v-model="editedItem.carbs"
                        label="Carbs (g)"
                      ></v-text-field>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-text-field
                        v-model="editedItem.protein"
                        label="Protein (g)"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="blue darken-1"
                  text
                  @click="close"
                >
                  Cancel
                </v-btn>
                <v-btn
                  color="blue darken-1"
                  text
                  @click="save"
                >
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

      <template v-slot:item.actions="{ item }">
        <v-icon
          small
          class="mr-2"
          @click="editItem(item)"
        >
          mdi-pencil
        </v-icon>
        <v-icon
          small
          @click="deleteItem(item)"
        >
          mdi-delete
        </v-icon>
      </template>
      <template v-slot:no-data>
        <v-btn
          color="primary"
          @click="initialize"
        >
          Reset
        </v-btn>
      </template>

      <template v-slot:item.validity="{ item }">
        <v-chip outlined small color="error"> {{ item.voucher.validity }} </v-chip>
      </template>
    </v-data-table>
  </template>
  <script>
    import { mapGetters, mapActions } from "vuex";
    export default {
      data: () => ({
        dialog: false,
        dialogDelete: false,
        headers: [
          {
            text: 'Bon cadeau N°',
            align: 'start',
            sortable: false,
            value: 'voucher.num',
          },
          { text: 'N° order', value: 'id' },
          { text: 'Client', value: 'customer.name' },
          { text: 'Bénéficiaire', value: 'beneficiary.name' },
          { text: 'Date commande', value: 'date_order' },
          { text: 'Date Validité', value: 'validity' },
          { text: 'Créé par', value: 'created_by.name' },
          { text: 'Status', value: 'status' },
          { text: 'Action', value: 'actions', sortable: false },

        ],
        orders: [],
        editedIndex: -1,
        editedItem:{
            date_order: "",
            customer: {
                name: "",
            },
            beneficiary: {
                name: "",
            },
            products: [],
            created_by: {
                name: ""
            },
            total: "",
            payment: {
                name: ""
            },
            voucher: {
                id: 1,
                num: "",
                validity: "",
            }
        },
        defaultItem: {
            date_order: "",
            customer: {
                first_name: "",
                last_name: "",
            },
            beneficiary: {
                first_name: "",
                last_name: "",
            },
            products: [],
            created_by: {
                name: ""
            },
            total: "",
            payment: {
                name: ""
            },
            voucher: {
                id: 1,
                num: "",
                validity: "",
            }
        },
      }),
      mounted () {
        this.colorChipsValidity('2022-10-30')
      },
      computed: {
        formTitle () {
          return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
        },
        ...mapGetters(['getOrders'])
      },

      watch: {
        dialog (val) {
          val || this.close()
        },
        dialogDelete (val) {
          val || this.closeDelete()
        },
      },

      created () {
        this.initialize()
      },

      methods: {
        colorChipsValidity(date)
        {
            var validity = new Date(date);
            var today = new Date();

            if()
            console.log(validity > today);
        },
        initialize () {
          this.orders = [
          ]
        },

        editItem (item) {
          this.editedIndex = this.orders.indexOf(item)
          this.editedItem = Object.assign({}, item)
          this.dialog = true
        },

        deleteItem (item) {
          this.editedIndex = this.orders.indexOf(item)
          this.editedItem = Object.assign({}, item)
          this.dialogDelete = true
        },

        deleteItemConfirm () {
          this.orders.splice(this.editedIndex, 1)
          this.closeDelete()
        },

        close () {
          this.dialog = false
          this.$nextTick(() => {
            this.editedItem = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
          })
        },

        closeDelete () {
          this.dialogDelete = false
          this.$nextTick(() => {
            this.editedItem = Object.assign({}, this.defaultItem)
            this.editedIndex = -1
          })
        },

        save () {
          if (this.editedIndex > -1) {
            Object.assign(this.orders[this.editedIndex], this.editedItem)
          } else {
            this.orders.push(this.editedItem)
          }
          this.close()
        },
      },
    }
  </script>
