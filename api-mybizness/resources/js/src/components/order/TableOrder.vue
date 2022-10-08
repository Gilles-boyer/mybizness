<template>
  <v-data-table
    :headers="headers"
    :items="getOrders"
    sort-by="date_order"
    class="elevation-1 font-weight-medium login"
  >
    <template v-slot:top>
      <v-toolbar flat color="#04153B10" class="mb-4">
        <v-row align="center" justify="center">
          <v-col cols="12" md="9" sm="12" xl="10"
            ><v-toolbar-title>Liste des commandes</v-toolbar-title></v-col
          >
          <v-col cols="12" md="3" sm="12" xl="2" ><dialogOrder /></v-col>
        </v-row>
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

    <template v-slot:item.date_order="{ item }">
        {{ getDateFormat(item.date_order) }}
    </template>

    <template v-slot:item.actions="{ item }">
      <v-icon small class="mr-2" @click="editItem(item)"> mdi-eye </v-icon>
      <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn color="primary"> Reset </v-btn>
    </template>

    <template v-slot:item.validity="{ item }">
      <v-chip outlined small :color="colorChipsValidity(item.voucher.validity)">
        {{ item.voucher.validity }}
      </v-chip>
    </template>

    <template v-slot:item.status="{ item }">
      <v-icon small :color="colorIconStatus(item.products)">
        mdi-circle
      </v-icon>
    </template>
  </v-data-table>
</template>
  <script>
import { mapGetters, mapActions } from "vuex";
import dialogOrder from "./DialogOrder.vue";
export default {
  components: {
    dialogOrder,
  },
  data: () => ({
    dialog: false,
    dialogDelete: false,
    headers: [
      {
        text: "Bon cadeau N°",
        align: "start",
        sortable: false,
        value: "voucher.num",
      },
      { text: "N° order", value: "id" },
      { text: "Client", value: "customer.name" },
      { text: "Bénéficiaire", value: "beneficiary.name" },
      { text: "Date commande", value: "date_order" },
      { text: "Date Validité", value: "validity" },
      { text: "Créé par", value: "created_by.name" },
      { text: "Status", value: "status" },
      { text: "Action", value: "actions", sortable: false },
    ],
  }),
  computed: {
    ...mapGetters(["getOrders"]),
  },

  watch: {
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },
  methods: {
    getDateFormat(date) {
        if(date) {
            return new Date(date).toLocaleDateString("fr-FR");
        }
        return new Date().toLocaleDateString("fr-FR");
    },
    colorIconStatus(products) {
      var nbProduct = products.length;
      var nbUsed = 0;
      products.forEach((product) => {
        if (product.used) {
          nbUsed++;
        }
      });
      if (nbUsed == 0) {
        return "#2e4200";
      } else if (nbUsed == nbProduct) {
        return "error";
      } else {
        return "orange";
      }
    },
    differenceTodayDays(date1) {
      var date1 = new Date(date1);
      var date2 = new Date();
      var difference = date1.getTime() - date2.getTime();
      return parseInt(difference / (1000 * 3600 * 24));
    },
    colorChipsValidity(date) {
      var days = this.differenceTodayDays(date);
      if (days < 0) {
        return "error";
      } else if (days < 10) {
        return "orange";
      } else {
        return "#2e4200";
      }
    },
    deleteItem(item) {
      this.editedIndex = this.orders.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.orders.splice(this.editedIndex, 1);
      this.closeDelete();
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
  },
};
</script>
