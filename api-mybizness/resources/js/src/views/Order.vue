<template>
  <v-container fluid class="pa-2" fill-height>
    <appBar :buttons="Buttons" :tabs="Tabs" @valueTab="setTabs($event)" />
    <card>
      <v-tabs-items v-model="Tabs" >
        <v-tab-item value="Gift">
            <table-order />
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
import TableOrder from '../components/order/TableOrder.vue';
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
          label: "Liste des Bénéficiaire",
          icon: "mdi-account",
          href: "Beneficiary",
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
          label: "Liste des Thèmes",
          icon: "mdi-image",
          href: "Theme",
        },
        {
          label: "Liste des Catégories",
          icon: "mdi-card-text",
          href: "Category",
        },
        {
          label: "Liste mode Paiement",
          icon: "mdi-credit-card-settings-outline",
          href: "Payment",
        }
      ],
      Tabs: "Gift",
    };
  },
  mounted() {
    this.initOrders();
  },

  components: {
    card,
    appBar,
    TableOrder,
    tableOrder
  },
  methods: {
    ...mapActions(["initOrders"]),
    setTabs(value) {
      this.Tabs = value;
    },
  },
};
</script>
