<template>
  <v-row justify="center">
    <v-dialog
      v-model="dialog"
      fullscreen
      hide-overlay
      transition="dialog-bottom-transition"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          small
          color="primary"
          dark
          v-bind="attrs"
          v-on="on"
          class="ml-3 px-6"
        >
          Nouveau Bon
        </v-btn>
      </template>

      <v-card>
        <v-toolbar dark color="primary" dense>
          <v-btn icon dark @click="dialog = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>

          <v-toolbar-title>Bon Cadeau</v-toolbar-title>

          <v-spacer></v-spacer>

          <v-toolbar-items>
            <v-btn dark text @click="dialog = false"> Save </v-btn>
          </v-toolbar-items>
        </v-toolbar>
        <v-row align-content="center" justify="center">
          <v-col cols="12" sm="11" md="9" xl="8">
            <v-card-title class="pb-0">
              Catalogue des produits disponibles en Ligne:
            </v-card-title>

            <v-card class="pa-6 mt-0" elevation="0">
              <!--Catalog product online-->
              <CatalogProduct @productToAdd="addProduct($event)" />

              <!--Form Data-->

              <v-card-title>
                Valeur de votre bon :
                <v-chip class="ml-2">{{ totalGifts }} €</v-chip>
              </v-card-title>

              <v-select
                v-model="gifts"
                :items="gifts"
                label="Liste des cadeaux"
                prepend-icon="mdi-gift"
                multiple
                item-text="label"
                return-object
              >
                <template v-slot:selection="{ item }">
                  <v-chip>
                    <v-avatar left>
                      <v-img :src="item.img"></v-img>
                    </v-avatar>
                    {{ item.label }}
                  </v-chip>
                </template>
              </v-select>

              <v-card-title> Le Client : </v-card-title>
              <v-autocomplete
                v-model="model"
                :items="items"
                :loading="isLoading"
                :search-input.sync="search"
                color="white"
                hide-no-data
                hide-selected
                item-text="Description"
                item-value="API"
                label="Public APIs"
                placeholder="Start typing to Search"
                prepend-icon="mdi-database-search"
                return-object
              ></v-autocomplete>
            </v-card>
          </v-col>
        </v-row>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import CatalogProduct from "./CatalogProduct.vue";
export default {
  data() {
    return {
      dialog: false,
      gifts: [],
    };
  },
  watch: {},
  methods: {
    ...mapActions(["updateUser"]),
    addProduct(product) {
      this.gifts.push(product);
    },
  },
  computed: {
    ...mapGetters(["getUsers"]),
    totalGifts() {
      var total = 0;
      if (this.gifts.length > 0) {
        this.gifts.forEach((item) => {
          total += item.price;
        });
      }
      return total;
    },
  },
  components: { CatalogProduct },
};
</script>