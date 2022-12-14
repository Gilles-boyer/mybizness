<template>
  <v-data-table
    :headers="headers"
    :items="polices"
    class="elevation-1 font-weight-medium login"
  >
    <template v-slot:top>
      <v-toolbar flat color="#04153B10" class="mb-12">
        <v-toolbar-title>Liste des polices</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
              Ajouter une police
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
                    Exemple : <h1 :style="'font-family:'+ editedItem.name +';'">ABCDabcd</h1>
                  </v-col>
                  <v-col cols="12" sm="12" md="12">
                    <v-text-field
                      v-model="editedItem.font"
                      label="Url"
                    ></v-text-field>
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

    <!-- police -->
    <template v-slot:item.font="{ item }">
        <div :style="`font-family:${item.name}`">
            ABCDabcd
        </div>
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
import apiFont from "../../services/axios/font";
import { mapActions } from "vuex";

export default {
  data: () => ({
    dialog: false,
    dialogDelete: false,
    headers: [
      {
        text: "Police",
        align: "start",
        sortable: false,
        value: "font",
      },
      { text: "Nom", value: "name" },
      { text: "Online", value: "online" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    polices: [],
    editedIndex: -1,
    editedItem: {
      id: 0,
      name: "",
      font: "",
      online: false,
    },
    defaultItem: {
      id: 0,
      name: "",
      font: "",
      online: false,
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Ajouter police" : "Modifier police";
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
      apiFont.getAllFonts().then((res) => {
        this.polices = res.data.data;
      });
    },

    chargePolice(item)
    {
        document.head.insertAdjacentHTML("beforeend", `<style>@import url('${item.font}');</style>`)
    },

    editItem(item) {
      this.editedIndex = this.polices.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.polices.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      apiFont.deleteFont(this.polices[this.editedIndex].id).then((res) => {
        this.polices.splice(this.editedIndex, 1);
        this.openSnack({
          message: "police supprim??",
          color: "success",
        });
        this.closeDelete();
      });
    },

    updateOnline(id) {
      apiFont
        .updateFontOnline(id)
        .then((res) => {
          this.openSnack({
            message: "police mis ?? jour",
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
      this.chargePolice(this.editedItem);
      if (this.editedIndex > -1) {
        apiFont
          .updateFont(this.polices[this.editedIndex].id, {
            name: this.editedItem.name,
            font: this.editedItem.font
          })
          .then((res) => {
            Object.assign(this.polices[this.editedIndex], this.editedItem);
            this.openSnack({
              message: "police modifi??e",
              color: "success",
            });
            this.close();
          })
          .catch((err) => console.log(err.toString()));
      } else {
        apiFont
          .storeNewFont({
            name: this.editedItem.name,
            font: this.editedItem.font
          })
          .then((res) => {
            this.polices.push(res.data.data);
            this.openSnack({
              message: "police cr????",
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
