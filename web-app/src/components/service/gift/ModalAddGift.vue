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
        <v-card class="pa-6" elevation="0">
          <v-form ref="form" v-model="valid" lazy-validation elevation="0">
            <v-card-title>
              Choix des produits :
              <v-chip color="primary" class="ml-1">{{ totalVoucher }} €</v-chip>
            </v-card-title>
            <v-autocomplete
              v-model="gifts"
              :rules="[(v) => v.length > 0 || 'Item is required']"
              :items="products"
              filled
              chips
              color="primary"
              label="Selectionner les produits"
              item-text="name"
              multiple
              return-object
            >
              <template v-slot:selection="data">
                <v-chip
                  v-bind="data.attrs"
                  :input-value="data.selected"
                  close
                  @click="data.select"
                  @click:close="remove(data.item)"
                >
                  <v-avatar left>
                    <v-img :src="data.item.img"></v-img>
                  </v-avatar>
                  {{ data.item.label }}
                </v-chip>
              </template>
              <template v-slot:item="data">
                <template v-if="typeof data.item !== 'object'">
                  <v-list-item-content v-text="data.item"></v-list-item-content>
                </template>
                <template v-else>
                  <v-list-item-avatar>
                    <img :src="data.item.img" />
                  </v-list-item-avatar>
                  <v-list-item-content>
                    <v-list-item-title>
                      {{ data.item.label }} - {{ data.item.price }} €
                    </v-list-item-title>
                    <v-list-item-subtitle
                      v-html="data.item.group"
                    ></v-list-item-subtitle>
                  </v-list-item-content>
                </template>
              </template>
            </v-autocomplete>

            <v-checkbox
              v-model="checkbox"
              :rules="[(v) => !!v || 'You must agree to continue!']"
              label="Do you agree?"
              required
            ></v-checkbox>

            <v-btn
              :disabled="!valid"
              color="success"
              class="mr-4"
              @click="validate"
            >
              Validate
            </v-btn>

            <v-btn color="error" class="mr-4" @click="reset">
              Reset Form
            </v-btn>

            <v-btn color="warning" @click="resetValidation">
              Reset Validation
            </v-btn>
          </v-form>
        </v-card>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
export default {
  data() {
    const srcs = {
      1: "https://www.letelegramme.fr/images/2019/07/12/cette-piste-du-gp-circuit-je-pourrais-la-faire-les-yeux_4687124.jpg",
      2: "https://cdn.abcmoteur.fr/wp-content/uploads/2014/12/Renault-Megane-RS-Easydrift.jpg",
      3: "https://cdn.vuetifyjs.com/images/lists/3.jpg",
      4: "https://cdn.vuetifyjs.com/images/lists/4.jpg",
      5: "https://cdn.vuetifyjs.com/images/lists/5.jpg",
    };
    return {
      autoUpdate: true,
      gifts: [],
      isUpdating: false,
      name: "Midnight Crew",
      products: [
        { header: "Karting" },
        {
          label: "1 session de karting",
          group: "Karting",
          price: 15,
          img: srcs[1],
        },
        { divider: true },
        { header: "Easydrift" },
        {
          label: "Bapteme Easydrift",
          group: "Easydrift",
          price: 39,
          img: srcs[2],
        },
      ],
      dialog: false,
      notifications: false,
      sound: true,
      widgets: false,
      valid: true,
      name: "",
      nameRules: [
        (v) => !!v || "Name is required",
        (v) => (v && v.length <= 10) || "Name must be less than 10 characters",
      ],
      email: "",
      emailRules: [
        (v) => !!v || "E-mail is required",
        (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
      ],
      select: null,
      items: ["Item 1", "Item 2", "Item 3", "Item 4"],
      checkbox: false,
    };
  },
  watch: {
    isUpdating(val) {
      if (val) {
        setTimeout(() => (this.isUpdating = false), 3000);
      }
    },
  },

  computed: {
    totalVoucher() {
      var total = 0;
      if (this.gifts.length > 0) {
        this.gifts.forEach((gift) => {
          total += gift.price;
        });
      }
      return total;
    },
  },

  methods: {
    remove(item) {
      const index = this.gifts.indexOf(item.name);
      if (index >= 0) this.gifts.splice(index, 1);
    },
    validate() {
      this.$refs.form.validate();
    },
    reset() {
      this.$refs.form.reset();
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },
  },
};
</script>