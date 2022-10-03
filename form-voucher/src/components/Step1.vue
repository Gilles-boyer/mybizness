<template>
  <v-row>
    <v-col cols="12">
      <v-alert type="error" v-if="error">Merci de selectionner un produit avant de continuer</v-alert>
    </v-col>

    <v-col cols="12" sm="12" md="6" xl="6">
      <v-toolbar dense elevation="0">
        <v-toolbar-title class="primary--text">Merci de choisir vos produits dans la liste :</v-toolbar-title>
      </v-toolbar>
      <CatalogProduct @productToAdd="addProduct($event)" />
    </v-col>

    <v-divider vertical></v-divider>
    <v-col cols="12" sm="12" md="6" xl="6">
      <v-toolbar dense elevation="0">
        <v-toolbar-title class="primary--text">Votre choix de Cadeaux :</v-toolbar-title>
      </v-toolbar>
      <v-data-table :headers="headers" :items="gifts" hide-default-footer>
        <template v-slot:item.img="{ item }">
          <v-avatar>
            <img :src="item.img" :alt="item.label" />
          </v-avatar>
        </template>
        <template v-slot:item.action="{ index }">
          <v-btn icon @click="deleteProduct(index)">
            <v-icon color="error" medium>mdi-delete</v-icon>
          </v-btn>
        </template>
        <template v-slot:body.append>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td style="background-color: #04153b" class="text-center font-weight-bold white--text">
              Total : {{ totalGifts }} €
            </td>
          </tr>
        </template>
      </v-data-table>
      <v-row justify="center" class="mt-4">
        <V-btn @click="goToStep2()" class="my-4" color="primary" :disabled="active">
          Continuer
        </V-btn>
      </v-row>
    </v-col>
  </v-row>
</template>
<script>
import CatalogProduct from "./CatalogProduct.vue";
export default {
  components: {
    CatalogProduct,
  },
  methods: {
    addProduct(product) {
      this.gifts.push(product);
    },
    deleteProduct(index) {
      this.gifts.splice(index, 1);
    },
    goToStep2() {
      this.error = false;
      if (this.gifts.length > 0 && this.totalGifts > 0) {
        this.$emit("listGifts", this.gifts);
      } else {
        this.error = true;
      }
    },
  },
  computed: {
    totalGifts() {
      var total = 0;
      this.active = true;
      if (this.gifts.length > 0) {
        this.active = false;
        this.gifts.forEach((item) => {
          total += parseInt(item.price);
        });
      }
      return total;
    },
  },
  data() {
    return {
      gifts: [],
      active: true,
      error: false,
      headers: [
        {
          text: "Image",
          align: "start",
          sortable: false,
          value: "img",
        },
        { text: "Produit", value: "label" },
        { text: "Prix", value: "price" },
        { text: "Action", value: "action" },
      ],
    };
  },
};
</script>