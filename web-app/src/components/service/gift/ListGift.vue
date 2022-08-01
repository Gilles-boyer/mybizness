<template>
  <v-data-table
    dense
    :headers="headers"
    :items="vouchers"
    sort-by="validityDate"
  >
    <template v-slot:top>
      <v-list>
        <v-list-item>
          <v-list-item-icon
            ><v-icon size="50" color="primary"
              >mdi-gift</v-icon
            ></v-list-item-icon
          >
          <v-list-item-title
            class="text-subtitle-1 text-md-h5 text-sm-subtitle-1"
          >
            Liste des bons cadeaux
          </v-list-item-title>
          <v-spacer></v-spacer>
          <v-text-field
            style="width: 600px"
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
            class="hidden-sm-and-down"
          ></v-text-field>
        </v-list-item>
        <v-list-item dense class="py-0">
          <v-list-item-action class="ma-0">
            <ModalAddGift />
          </v-list-item-action>
        </v-list-item>
        <v-list-item>
          <v-list-item-action-text class="mx-auto" style="width: 100%">
            <v-text-field
              style="width: 100%"
              v-model="search"
              append-icon="mdi-magnify"
              label="Search"
              single-line
              hide-details
              class="hidden-md-and-up"
            ></v-text-field>
          </v-list-item-action-text>
        </v-list-item>
      </v-list>
    </template>

    <template v-slot:item.client="{ item }">
      {{ item.client.firstName }} {{ item.client.lastName }}
    </template>

    <template v-slot:item.staff="{ item }">
      {{ item.staff.firstName }} {{ item.staff.lastName }}
    </template>

    <template v-slot:item.beneficiary="{ item }">
      {{ item.beneficiary.firstName }} {{ item.beneficiary.lastName }}
    </template>

    <template v-slot:item.status="{ item }">
      <v-switch v-model="item.status" color="green" disabled> </v-switch>
    </template>

    <template v-slot:item.actions="{ item }">
      <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
      <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
    </template>

    <template v-slot:no-data>
      <v-btn color="primary" @click="initialize"> Reset </v-btn>
    </template>
  </v-data-table>
</template>

<script>
import ModalAddGift from "./ModalAddGift.vue";
export default {
  data: () => ({
    dialog: false,
    search: "",
    dialogDelete: false,
    headers: [
      {
        text: "N° du bon",
        align: "start",
        sortable: false,
        value: "id",
      },
      { text: "Client", value: "client" },
      { text: "Bénéficiaire", value: "beneficiary" },
      { text: "Staff", value: "staff" },
      { text: "Créé le ", value: "createdDate" },
      { text: "Validité", value: "validityDate" },
      { text: "status", value: "status" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    vouchers: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0,
    },
    defaultItem: {
      name: "",
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0,
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
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
    initialize() {
      this.vouchers = [
        {
          id: "62e384402470041c0001a9fb",
          client: {
            id: "72e384402470041c0001a9fb",
            firstName: "Hugo",
            lastName: "BOYER",
            mail: "h.boyer@gmail.com",
            tel: "0692000000",
          },
          beneficiary: {
            id: "82e384402470041c0001a9fb",
            firstName: "Emmanuelle",
            lastName: "BOYER",
            mail: "e.boyer@gmail.com",
            tel: "0692536084",
          },
          staff: {
            id: "92e384402470041c0001a9fb",
            firstName: "Gilles",
            lastName: "BOYER",
          },
          gifts: [
            {
              id: "62e384402470041c0001a9gh",
              label: "1 session de karting 10min",
              price: 15,
              usedTo: "",
              updateBy: "",
            },
            {
              id: "62e384402470061c0001a9gh",
              label: "1 cagoule",
              price: 3,
              usedTo: "",
              updateBy: "",
            },
          ],
          theme: {
            id: "62e384502470061c0001a9gh",
            img: "https://s3.amazonaws.com/thumbnails.venngage.com/template/5456834b-ba95-41a9-85b2-4abd4d313c11.png",
          },
          createdDate: "31/07/2022",
          validityDate: "30/10/2022",
          message: "Joyeux annif mon grand",
          status: true,
          paiement: {
            origine: "vosfactures",
            mount: 18,
          },
        },
      ];
    },

    editItem(item) {
      this.editedIndex = this.vouchers.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.vouchers.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.vouchers.splice(this.editedIndex, 1);
      this.closeDelete();
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
        Object.assign(this.vouchers[this.editedIndex], this.editedItem);
      } else {
        this.vouchers.push(this.editedItem);
      }
      this.close();
    },
  },
  components: {
    ModalAddGift,
  },
};
</script>