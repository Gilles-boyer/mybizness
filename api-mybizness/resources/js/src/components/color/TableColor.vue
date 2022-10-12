<template>
  <v-data-table
    :headers="headers"
    :items="colors"
    class="elevation-1 font-weight-medium login"
  >
    <template v-slot:top>
      <v-toolbar flat color="#04153B10" class="mb-12">
        <v-toolbar-title>Liste des couleurs</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
              Ajouter une couleur
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container >
                <v-row justify="center" align="center">
                  <v-col cols="12" sm="12" md="12">
                    <v-color-picker class="mx-auto" mode="hexa" v-model="editedItem.hex"></v-color-picker>
                  </v-col>
                  <v-col cols="12" sm="12" md="12">
                    <v-text-field
                      v-model="editedItem.name"
                      label="Nom"
                    ></v-text-field>
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

    <!-- color -->
    <template v-slot:item.hex="{ item }">
        <v-icon :color="item.hex" x-large>
            mdi-circle
        </v-icon>
    </template>
    <!--  -->

    <!-- online -->
    <template v-slot:item.online="{ item }">
      <v-switch
        v-model="item.online"
        @change="updateOnline(item.id)"
        inset
      ></v-switch>
    </template>

    <template v-slot:no-data>
      <v-btn color="primary" @click="initialize"> Reset </v-btn>
    </template>
  </v-data-table>
</template>

<script>
import apiColor from "../../services/axios/color";
import { mapActions } from "vuex";

export default {
  data: () => ({
    dialog: false,
    dialogDelete: false,
    headers: [
      {
        text: "Color",
        align: "start",
        sortable: false,
        value: "hex",
      },
      { text: "Nom", value: "name" },
      { text: "Online", value: "online" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    colors: [],
    editedIndex: -1,
    editedItem: {
      id: 0,
      name: "",
      hex: "",
      online: false,
    },
    defaultItem: {
      id: 0,
      name: "",
      hex: "",
      online: false,
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Ajouter une couleur" : "Modifier la couleur";
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
      apiColor.getAllColors().then((res) => {
        this.colors = res.data.data;
      });
    },

    editItem(item) {
      this.editedIndex = this.colors.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.colors.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
        apiColor.deleteColor(this.colors[this.editedIndex].id).then((res) => {
        this.colors.splice(this.editedIndex, 1);
        this.openSnack({
          message: "couleur supprimé",
          color: "success",
        });
        this.closeDelete();
      });
    },

    updateOnline(id) {
        apiColor
        .updateColorOnline(id)
        .then((res) => {
          this.openSnack({
            message: "couleur mis à jour",
            color: "success",
          });
        })
        .catch((err) => console.log(err.toString()));
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
        apiColor
          .updateColor(this.colors[this.editedIndex].id, {
            name: this.editedItem.name,
            hex: this.editedItem.hex
          })
          .then((res) => {
            Object.assign(this.colors[this.editedIndex], this.editedItem);
            this.openSnack({
              message: "couleur modifiée",
              color: "success",
            });
            this.close();
          })
          .catch((err) => console.log(err.toString()));
      } else {
        apiColor
           .storeNewColor({
            name: this.editedItem.name,
            hex: this.editedItem.hex
          })
          .then((res) => {
            this.colors.push(res.data.data);
            this.openSnack({
              message: "couleur créé",
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
