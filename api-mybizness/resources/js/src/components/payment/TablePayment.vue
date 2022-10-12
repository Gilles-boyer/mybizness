<template>
  <v-data-table
    :headers="headers"
    :items="payments"
    class="elevation-1 font-weight-medium login"
  >
    <template v-slot:top>
      <v-toolbar flat color="#04153B10" class="mb-12">
        <v-toolbar-title>Liste des paiements</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
              Ajouter une paiement
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
                    <v-text-field
                      v-model="editedItem.name"
                      label="Nom"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="12" md="12">
                    <v-text-field
                      v-model="editedItem.description"
                      label="Description"
                    >
                    </v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close"> Cancel </v-btn>
              <v-btn color="blue darken-1" text @click="save"> Save </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5"
              >Are you sure you want to delete this item?</v-card-title
            >
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete"
                >Cancel</v-btn
              >
              <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                >OK</v-btn
              >
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>

    <!-- action -->
    <template v-slot:item.actions="{ item }">
      <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
      <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
    </template>
    <!--  -->

    <!-- paiement -->
    <template v-slot:item.icon="{ item }">
      <v-icon x-large>
        {{ item.icon }}
      </v-icon>
    </template>
    <!--  -->

    <template v-slot:no-data>
      <v-btn color="primary" @click="initialize"> Reset </v-btn>
    </template>
  </v-data-table>
</template>

<script>
import apiPayment from "../../services/axios/payment";
import { mapActions } from "vuex";

export default {
  data: () => ({
    dialog: false,
    dialogDelete: false,
    headers: [
      {
        text: "Nom",
        align: "start",
        sortable: false,
        value: "name",
      },
      { text: "Description", value: "description" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    payments: [],
    editedIndex: -1,
    editedItem: {
      id: 0,
      name: "",
      description: "",
    },
    defaultItem: {
      id: 0,
      name: "",
      description: "",
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1
        ? "Ajouter paiement"
        : "Modifier paiement";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    ...mapActions(["openSnack"]),
    initialize() {
      apiPayment.getAllTypePayment().then((res) => {
        this.payments = res.data.data;
      });
    },

    editItem(item) {
      this.editedIndex = this.payments.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.payments.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
         apiPayment.deletePayment(this.payments[this.editedIndex].id)
        .then((res) => {
          this.payments.splice(this.editedIndex, 1);
          this.openSnack({
            message: "paiement supprimée",
            color: "success",
          });
          this.closeDelete();
        });
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        apiPayment.updatePayment(this.payments[this.editedIndex].id, {
            name: this.editedItem.name,
            description: this.editedItem.description,
          })
          .then((res) => {
            Object.assign(this.payments[this.editedIndex], this.editedItem);
            this.openSnack({
              message: "paiement modifiée",
              color: "success",
            });
            this.close();
          })
          .catch((err) => console.log(err.toString()));
      } else {
        apiPayment.storeNewPayment({
            name: this.editedItem.name,
            description: this.editedItem.description,
          })
          .then((res) => {
            this.payments.push(res.data.data);
            this.openSnack({
              message: "paiement créé",
              color: "success",
            });
            this.close();
          })
          .catch((err) => console.log(err.toString()));
      }
    },
  },
};
</script>
