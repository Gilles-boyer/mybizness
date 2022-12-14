<template>
  <v-data-table
    :headers="headers"
    :items="products"
    class="elevation-1 font-weight-medium login"
  >
    <template v-slot:top>
      <v-toolbar flat color="#04153B10" class="mb-12">
        <v-toolbar-title>Liste des produits</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
              Ajouter une produit
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
                    <v-img :src="editedItem.img"></v-img>
                  </v-col>
                  <v-col cols="12" sm="12" md="12">
                    <v-text-field
                      v-model="editedItem.img"
                      label="Url image"
                    ></v-text-field>
                  </v-col>
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
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="12" md="12">
                    <v-text-field
                      v-model="editedItem.price"
                      label="Prix"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="12" md="12">
                    <v-select
                      :items="categories"
                      item-text="name"
                      v-model="editedItem.category"
                      label="Cat??gorie"
                      return-object
                    ></v-select>
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

    <!-- produit -->
    <template v-slot:item.img="{ item }">
      <v-avatar class="profile" color="grey" size="100" tile>
        <v-img :src="item.img"></v-img>
      </v-avatar>
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
import apiProduct from "../../services/axios/product";
import apiCategory from "../../services/axios/category";
import { mapActions } from "vuex";

export default {
  data: () => ({
    dialog: false,
    dialogDelete: false,
    headers: [
      {
        text: "Image",
        align: "start",
        sortable: false,
        value: "img",
      },
      { text: "Nom", value: "name" },
      { text: "Description", value: "description" },
      { text: "Prix", value: "price" },
      { text: "Categorie", value: "category.name" },
      { text: "Online", value: "online" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    products: [],
    categories: [],
    editedIndex: -1,
    editedItem: {
      id: 0,
      name: "",
      description: "",
      price: "",
      img: "",
      online: false,
      category: {},
    },
    defaultItem: {
      id: 0,
      name: "",
      description: "",
      price: "",
      img: "",
      online: false,
      category: {},
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Ajouter produit" : "Modifier produit";
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
      apiProduct.getAllProducts().then((res) => {
        this.products = res.data.data;
      });
      apiCategory.getAllCategories().then((res) => {
        this.categories = res.data.data;
      });
    },

    editItem(item) {
      this.editedIndex = this.products.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.products.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      apiProduct
        .deleteProduct(this.products[this.editedIndex].id)
        .then((res) => {
          this.products.splice(this.editedIndex, 1);
          this.openSnack({
            message: "produit supprim??",
            color: "success",
          });
          this.closeDelete();
        });
    },

    updateOnline(id) {
      apiProduct
        .updateProductOnline(id)
        .then((res) => {
          this.openSnack({
            message: "produit mis ?? jour",
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
        apiProduct
          .updateProduct(this.products[this.editedIndex].id, {
            name: this.editedItem.name,
            description: this.editedItem.description,
            img: this.editedItem.img,
            price: this.editedItem.price,
            category_id: this.editedItem.category.id,
          })
          .then((res) => {
            Object.assign(this.products[this.editedIndex], this.editedItem);
            this.openSnack({
              message: "produit modifi??e",
              color: "success",
            });
            this.close();
          })
          .catch((err) => console.log(err.toString()));
      } else {
        apiProduct
          .storeNewProduct({
            name: this.editedItem.name,
            description: this.editedItem.description,
            img: this.editedItem.img,
            price: this.editedItem.price,
            category_id: this.editedItem.category.id,
          })
          .then((res) => {
            this.products.push(res.data.data);
            this.openSnack({
              message: "produit cr????",
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
