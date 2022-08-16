<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="primary" rounded class="mx-auto" v-bind="attrs" v-on="on">
          Ajouter un Circuit
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">{{ title }}</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-form ref="form" v-model="valid" lazy-validation>
              <v-row>
                <v-col cols="12">
                  <v-text-field
                    v-model="name"
                    :rules="[rule.required]"
                    label="Nom du circuit*"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12" sm="12" md="12">
                  <v-text-field
                    v-model="adresse"
                    label="adresse"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" sm="6" md="5">
                  <v-text-field
                    :rules="[rule.required]"
                    v-model="tel"
                    label="Téléphone*"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12" sm="6" md="7">
                  <v-text-field
                    :rules="[rule.required]"
                    v-model="email"
                    label="Email*"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="6" sm="4" md="3">
                  <v-text-field
                    :rules="[rule.required]"
                    label="Heure d'ouverture*"
                    type="time"
                    v-model="open"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="6" sm="4" md="3">
                  <v-text-field
                    :rules="[rule.required]"
                    label="Heure de fermeture*"
                    type="time"
                    v-model="close"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="6" sm="4" md="3">
                  <v-text-field
                    :rules="[rule.required]"
                    label="Heure de pause*"
                    v-model="pause_start"
                    type="time"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="6" sm="4" md="3">
                  <v-text-field
                    :rules="[rule.required]"
                    label="fin de pause*"
                    v-model="pause_end"
                    type="time"
                    required
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-form>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="closeModal()">
            Close
          </v-btn>
          <v-btn
            :disabled="!valid"
            color="blue darken-1"
            text
            @click="createCircuit()"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>


<script>
export default {
  methods: {
    createCircuit() {
      if (this.$refs.form.validate()) {
        if (this.Modify) {
          this.modifyCircuit();
        } else {
          this.addCircuit();
        }
        this.closeModal();
      }
    },

    addCircuit() {
      this.$emit("createCircuit", {
        name: this.name,
        adresse: this.adresse,
        tel: this.tel,
        email: this.email,
        open: this.open,
        close: this.close,
        pause_start: this.pause_start,
        pause_end: this.pause_end,
      });
    },

    modifyCircuit() {
      this.$emit("updateCircuit", {
        id: this.itemSelected.id,
        name: this.name,
        adresse: this.adresse,
        tel: this.tel,
        email: this.email,
        open: this.open,
        close: this.close,
        pause_start: this.pause_start,
        pause_end: this.pause_end,
      });
    },

    closeModal() {
      this.dialog = false;
      this.$refs.form.reset();
      this.$emit("closeModal");
    },
  },
  data: () => ({
    dialog: false,
    valid: true,
    rule: {
      required: (v) => !!v || "Name is required",
    },
    name: "",
    adresse: "",
    tel: "",
    email: "",
    open: "",
    close: "",
    pause_start: "",
    pause_end: "",
  }),

  props: {
    Modify: {
      type: Boolean,
      default: false,
    },
    itemSelected: {
      type: Object,
    },
  },

  computed: {
    title() {
      var Title = "Ajouter un nouveau Circuit";
      if (this.Modify) {
        Title = "Modifier le Circuit";

        this.name = this.itemSelected.name;
        this.adresse = this.itemSelected.adresse;
        this.tel = this.itemSelected.tel;
        this.email = this.itemSelected.email;
        this.open = this.itemSelected.open;
        this.close = this.itemSelected.close;
        this.pause_start = this.itemSelected.pause_start;
        this.pause_end = this.itemSelected.pause_end;

        this.dialog = true;
      }
      return Title;
    },
  },
};
</script>