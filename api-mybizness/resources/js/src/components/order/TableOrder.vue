<template>
  <div>
    <v-data-table
      :headers="headers"
      :items="orders"
      :search="search"
      sort-desc
      sort-by="date_order"
      class="elevation-1 font-weight-medium login"
    >
      <template v-slot:top>
        <v-toolbar flat color="#04153B10" class="py-2 mb-3">
          <v-row align="center" justify="center">
            <modalVoucher
              :dialog="dialogVoucher"
              :voucher="dataVoucher"
              @closeModalVoucher="dialogVoucher = false"
            />
            <v-col cols="12" md="9" sm="12" xl="9"
              ><v-toolbar-title>Liste des commandes</v-toolbar-title></v-col
            >
            <v-col cols="12" md="3" sm="12" xl="3"><dialogOrder/></v-col>
          </v-row>
        </v-toolbar>
        <v-row class="px-4 mb-2">
        <v-col cols="12" sm="12" md="8" xl="8">
          <v-switch
            v-model="ordersFinish"
            inset
            label="Voir les bons terminés"
          ></v-switch>
        </v-col>
        <v-col cols="12" sm="12" md="4" xl="">
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
          ></v-text-field>
        </v-col>
      </v-row>
      </template>

      <template v-slot:item.date_order="{ item }">
        {{ getDateFormat(item.date_order) }}
      </template>

      <template v-slot:item.actions="{ item, index }">
        <v-icon small class="mr-2" @click="openModalVoucher(item)">
          mdi-eye
        </v-icon>
        <v-icon
          v-if="!(colorIconStatus(item.products) == 'error')"
          small
          class="mr-2"
          @click="downloadPdfvoucher(item)"
        >
          mdi-download
        </v-icon>
        <v-icon
          v-if="!(colorIconStatus(item.products) == 'error')"
          small
          class="mr-2"
          @click="displayPdfVoucher(item)"
        >
          mdi-printer
        </v-icon>
        <v-icon
          v-if="!(colorIconStatus(item.products) == 'error')"
          small
          @click="deleteItem(item, index)"
        >
          mdi-delete
        </v-icon>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary"> Reset </v-btn>
      </template>
      <template v-slot:item.validity="{ item }">
        <v-chip
          v-if="!(colorIconStatus(item.products) == 'error')"
          outlined
          small
          :color="colorChipsValidity(item.voucher.validity)"
        >
          {{ getDateFormat(item.voucher.validity) }}
        </v-chip>
      </template>

      <template v-slot:item.status="{ item }">
        <v-icon small :color="colorIconStatus(item.products)">
          mdi-circle
        </v-icon>
      </template>
    </v-data-table>
  </div>
</template>
  <script>
import { mapGetters, mapActions } from "vuex";
import dialogOrder from "./DialogOrder.vue";
import modalVoucher from "../voucher/DialogGetVoucher.vue";
export default {
  components: {
    dialogOrder,
    modalVoucher,
  },
  data: () => ({
    ordersFinish: false,
    search:"",
    dialog: false,
    dialogDelete: false,
    dialogVoucher: false,
    dataVoucher: {
      date_order: Date.now(),
      products: [],
      voucher: {
        color: {},
        font: {},
        image: {},
        validity: Date.now(),
      },
      customer: {
        name: "",
      },
      beneficiary: {
        name: "",
      },
      created_by: {},
      payment:{}
    },
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
      { text: "Payé par", value: "payment.name" },
      { text: "Créé par", value: "created_by.name" },
      { text: "Status", value: "status" },
      { text: "Action", value: "actions", sortable: false },
    ],
  }),
  computed: {
    ...mapGetters(["getOrders"]),
    orders(){
        if(!this.ordersFinish){
            return this.getOrders.filter(order => this.colorIconStatus(order.products) != "error");
        }
        return this.getOrders
    }
  },

  watch: {
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },
  methods: {
    openModalVoucher(item) {
      this.dialogVoucher = true;
      this.dataVoucher = item;
    },
    ...mapActions(["deleteOrder"]),
    async displayPdfVoucher(data) {
      window.open(`/api/voucher/display/pdf/${data.voucher.num}`, "_blank");
    },
    async downloadPdfvoucher(data) {
      window.open(`/api/voucher/download/pdf/${data.voucher.num}`, "_blank");
    },
    getDateFormat(date) {
      if (date) {
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
    deleteItem(item, index) {
      if (
        confirm(
          "Merci de confirmer que vous souhaitez effacé la commande : " +
            item.voucher.num +
            " ?"
        )
      ) {
        this.deleteOrder({
          id: item.id,
          index: index,
        });
      }
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
