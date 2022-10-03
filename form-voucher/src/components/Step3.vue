<template>
  <v-form ref="form" v-model="valid" lazy-validation>
    <v-row>
      <v-col cols="12" sm="12" md="6" xl="6">
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title class="font-weight-bold text--primary"
              >Vos Informations :
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-checkbox
          v-model="checkbox"
          label="Ce cadeau est pour moi"
          required
        ></v-checkbox>

        <v-text-field
          v-model="client.lastName"
          :rules="[rule.required, rule.minChar]"
          label="Nom"
          required
        >
        </v-text-field>

        <v-text-field
          v-model="client.firstName"
          :rules="[rule.required, rule.minChar]"
          label="Prénom"
          required
        >
        </v-text-field>

        <v-text-field
          v-model="client.tel"
          :counter="10"
          :rules="[rule.required, rule.minCharTel, rule.number]"
          label="Téléphone"
          required
        ></v-text-field>

        <v-text-field
          v-model="client.email"
          :rules="[rule.required, rule.validMail]"
          label="E-mail"
          required
        >
        </v-text-field>

        <v-select
          v-model="shipping"
          :items="shippings"
          item-text="name"
          :rules="[rule.required]"
          label="Mode de transmission du bon cadeau"
          required
          return-object
        ></v-select>
      </v-col>

      <v-divider vertical></v-divider>

      <v-col cols="12" v-if="!checkbox" sm="12" md="6" xl="6">
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title class="font-weight-bold text--primary"
              >Les informations du bénéficiaire :
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-text-field
          v-model="beneficiary.lastName"
          :rules="[rule.required, rule.minChar]"
          label="Nom"
          required
        >
        </v-text-field>

        <v-text-field
          v-model="beneficiary.firstName"
          :rules="[rule.required, rule.minChar]"
          label="Prénom"
          required
        >
        </v-text-field>

        <v-text-field
          v-model="beneficiary.tel"
          :counter="10"
          :rules="[rule.required, rule.minCharTel, rule.number]"
          label="Téléphone"
          required
        ></v-text-field>

        <v-text-field
          v-if="!shipping.beneficiaryMailOptional"
          v-model="beneficiary.email"
          :rules="[rule.required, rule.validMail]"
          label="E-mail"
          required
        ></v-text-field>
      </v-col>

      <v-col cols="12">
        <v-row align="center" justify="center" class="pa-3">
          <v-btn
            :disabled="!valid"
            color="primary"
            width="30%"
            @click="validate"
          >
            Validate
          </v-btn>
        </v-row>
      </v-col>
    </v-row>
  </v-form>
</template>
<script>
import apiShipping from "../service/shipping";
export default {
  data: () => ({
    valid: true,
    client: {
      firstName: "",
      lastName: "",
      tel: "",
      email: "",
    },
    beneficiary: {
      firstName: "",
      lastName: "",
      tel: "",
      email: "",
    },
    shipping: "",
    rule: {
      required: (v) => !!v || "Ce champ est obligatoire",
      minCharTel: (v) =>
        !(v.length != 10) ||
        "Merci de saisir le nombre minimun de caratère : 10",
      validMail: (v) => /.+@.+\..+/.test(v) || "Merci de saisir un mail valide",
      minChar: (v) => v.length >= 3 || "Merci de saisir plus de 2 caratères",
      number: (v) => /[0-9]/.test(v) || "Merci de saisir que des chiffres",
    },

    shippings: [],
    checkbox: false,
  }),

  mounted() {
    this.initShipping();
  },

  methods: {
    async initShipping() {
      var res = await apiShipping.getShipping();
      this.shippings = res.data.data;
    },
    validate() {
      if (this.$refs.form.validate()) {
        var dataForm = {
          customer: this.client,
          shipping: this.shipping,
        };

        if (this.checkbox) {
          dataForm.beneficiary = this.client;
        } else {
          dataForm.beneficiary = this.beneficiary;
        }

        this.$emit("dataForm", dataForm);
      }
    },
  },
};
</script>