<template>
  <v-container fluid class="pa-2" fill-height>
    <appBar :buttons="Buttons" :tabs="Tabs" @valueTab="setTabs($event)" />
    <card>
      <v-tabs-items v-model="Tabs">
        <v-tab-item value="Gift">
          <table-order />
        </v-tab-item>
        <v-tab-item value="Image">
          <table-image />
        </v-tab-item>
        <v-tab-item value="Font">
          <table-font />
        </v-tab-item>
        <v-tab-item value="Color">
          <table-color />
        </v-tab-item>
        <v-tab-item value="Category">
          <table-category />
        </v-tab-item>
        <v-tab-item value="Product">
          <table-product />
        </v-tab-item>
        <v-tab-item value="Shipping">
          <table-shipping />
        </v-tab-item>
        <v-tab-item value="Payment">
          <table-payment />
        </v-tab-item>
      </v-tabs-items>
    </card>
  </v-container>
</template>


  <script>
import tableOrder from "../components/order/TableOrder.vue";
import appBar from "../components/application/AppBar.vue";
import card from "../components/card/Card.vue";
import { mapActions } from "vuex";
import TableOrder from "../components/order/TableOrder.vue";
import TableImage from "../components/image/TableImage.vue";
import TableFont from "../components/font/TableFont.vue";
import TableColor from "../components/color/TableColor.vue";
import TableCategory from "../components/category/TableCategory.vue";
import TableProduct from "../components/product/TableProduct.vue";
import TableShipping from "../components/shipping/TableShipping.vue";
import TablePayment from "../components/payment/TablePayment.vue";
import apiFont from "../services/axios/font";
export default {
  data() {
    return {
      Buttons: [
        {
          label: "Liste des bons cadeau",
          icon: "mdi-gift",
          href: "Gift",
        },
        {
          label: "Liste des Produits",
          icon: "mdi-toolbox-outline",
          href: "Product",
        },
        {
          label: "Liste des Méthode d'envois",
          icon: "mdi-send",
          href: "Shipping",
        },
        {
          label: "Liste des Images",
          icon: "mdi-image",
          href: "Image",
        },
        {
          label: "Liste des polices",
          icon: "mdi-format-font",
          href: "Font",
        },
        {
          label: "Liste des couleurs",
          icon: "mdi-palette",
          href: "Color",
        },
        {
          label: "Liste des Catégories",
          icon: "mdi-tag",
          href: "Category",
        },
        {
          label: "Liste mode Paiement",
          icon: "mdi-credit-card-settings-outline",
          href: "Payment",
        },
      ],
      Tabs: "Gift",
    };
  },
  mounted() {
    this.initOrders();
    this.initFont();
  },

  components: {
    card,
    appBar,
    TableOrder,
    tableOrder,
    TableImage,
    TableFont,
    TableColor,
    TableCategory,
    TableProduct,
    TableShipping,
    TablePayment,
  },
  methods: {
    ...mapActions(["initOrders"]),
    setTabs(value) {
      this.Tabs = value;
    },
    initFont() {
      apiFont.getAllFonts().then((res) => {
        res.data.data.forEach((font) => this.chargePolice(font));
      });
    },
    chargePolice(item) {
      document.head.insertAdjacentHTML(
        "beforeend",
        `<style>@import url('${item.font}');</style>`
      );
    },
  },
};
</script>
