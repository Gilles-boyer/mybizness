<template>
  <v-row justify="center">
    <v-col cols="12" sm="12" md="5" xl="5">
      <v-card shaped class="px-2" elevation="0">
        <v-alert type="error" v-if="error"
        >Merci de selectionner un produit avant de continuer</v-alert
      >
        <v-card-title class="primary--text"
          >Merci de choisir vos produits dans la liste :</v-card-title
        >
        <CatalogProduct @productToAdd="addProduct($event)" />
      </v-card>
    </v-col>
    <v-col cols="12" sm="12" md="5" xl="5">
      <v-card shaped elevation="0">
        <v-card-title class="primary--text"
          >Votre choix de Cadeaux :</v-card-title
        >
        <v-data-table
          :headers="headers"
          :items="getGifts"
          item-key="index"
          hide-default-footer
        >
          <template v-slot:item.img="{ item }">
            <v-avatar>
              <img :src="item.img" :alt="item.name" />
            </v-avatar>
          </template>
          <template v-slot:item.action="{ index }">
            <v-btn icon @click="deleteProduct(index)">
              <v-icon color="#04153B70" medium>mdi-delete</v-icon>
            </v-btn>
          </template>
          <template v-slot:body.append>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td
                style="background-color: #04153b"
                class="text-center font-weight-bold white--text"
              >
                Total : {{ getTotalGifts }} €
              </td>
            </tr>
          </template>
        </v-data-table>
        <v-card-actions>
          <v-btn
            @click="goToStep2()"
            class="my-4 mx-auto"
            width="60%"
            color="primary"
            :disabled="active"
          >
            Continuer
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-col>
  </v-row>
</template>
<script>
import CatalogProduct from "./CatalogProduct.vue";
import {mapGetters, mapActions} from "vuex";
export default {
  components: {
    CatalogProduct,
  },
  methods: {
    ...mapActions(['addGift', 'deleteGift']),
    addProduct(product) {
       this.addGift(product)
    },
    deleteProduct(index) {
      this.deleteGift(index);
    },
    goToStep2() {
      this.error = false;
      if (this.getGifts.length > 0 && this.getTotalGifts > 0) {
        this.$emit("goStep2");
      } else {
        this.error = true;
      }
    },
  },
  computed: {
    ...mapGetters(['getGifts', 'getTotalGifts']),
    active() {
      if (this.getGifts.length > 0) {
        return false;
      }
      return true;
    },
  },

  data() {
    return {
      error: false,
      headers: [
        {
          text: "Image",
          align: "start",
          sortable: false,
          value: "img",
        },
        { text: "Produit", value: "name" },
        { text: "Prix", value: "price" },
        { text: "Action", value: "action" },
      ],
    };
  },
};
</script>
