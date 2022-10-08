<template>
  <v-form ref="formStep3" v-model="valid" lazy-validation>
    <v-row justify="center">
      <v-col cols="12" sm="12" md="5" xl="5">
        <v-card class="pa-3" elevation="0" shaped>
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title class="font-weight-bold text--primary"
                >Informations du client :
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-checkbox
            v-model="checkbox"
            label="Ce cadeau est pour le client"
            required
          ></v-checkbox>

          <v-text-field
            v-model="getCustomerStep3.lastName"
            :rules="[rule.required, rule.minChar]"
            label="Nom"
            required
          >
          </v-text-field>

          <v-text-field
            v-model="getCustomerStep3.firstName"
            :rules="[rule.required, rule.minChar]"
            label="Prénom"
            required
          >
          </v-text-field>

          <v-text-field
            v-model="getCustomerStep3.tel"
            :counter="10"
            :rules="[rule.required, rule.minCharTel, rule.number]"
            label="Téléphone"
            required
          ></v-text-field>

          <v-text-field
            v-model="getCustomerStep3.email"
            :rules="[rule.required, rule.validMail]"
            label="E-mail"
            required
          >
          </v-text-field>

          <v-select
            v-model="shippingMethod"
            :items="getShippingsOnline"
            item-text="name"
            :rules="[rule.required]"
            label="Mode de transmission du bon cadeau"
            required
            return-object
          >
            <template v-slot:item="{ item }">
              <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <h6 v-bind="attrs" v-on="on">{{ item.name }}</h6>
                </template>
                <span>{{ item.description }}</span>
              </v-tooltip>
            </template>
          </v-select>

          <v-select
            v-model="paymentMethod"
            :items="getPayments"
            item-text="name"
            :rules="[rule.required]"
            label="Mode de paiement du bon cadeau"
            required
            return-object
          >
            <template v-slot:item="{ item }">
              <v-tooltip bottom>
                <template v-slot:activator="{ on, attrs }">
                  <h6 v-bind="attrs" v-on="on">{{ item.name }}</h6>
                </template>
                <span>{{ item.description }}</span>
              </v-tooltip>
            </template>
          </v-select>
        </v-card>
      </v-col>

      <v-col cols="12" v-if="!checkbox" sm="12" md="5" xl="5">
        <v-card class="pa-3" elevation="0" shaped>
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title class="font-weight-bold text--primary"
                >Informations du bénéficiaire :
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-text-field
            v-model="getBeneficiaryStep3.lastName"
            :rules="[rule.required, rule.minChar]"
            label="Nom"
            required
          >
          </v-text-field>

          <v-text-field
            v-model="getBeneficiaryStep3.firstName"
            :rules="[rule.required, rule.minChar]"
            label="Prénom"
            required
          >
          </v-text-field>

          <v-text-field
            v-model="getBeneficiaryStep3.tel"
            :counter="10"
            :rules="[rule.required, rule.minCharTel, rule.number]"
            label="Téléphone"
            required
          ></v-text-field>

          <v-text-field
            v-if="!shippingMethod.beneficiaryMailOptional"
            v-model="getBeneficiaryStep3.email"
            :rules="[rule.required, rule.validMail]"
            label="E-mail"
            required
          ></v-text-field>
        </v-card>
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
import { mapGetters, mapActions } from "vuex";
export default {
  data: () => ({
    valid: true,
    rule: {
      required: (v) => !!v || "Ce champ est obligatoire",
      minCharTel: (v) =>
        !(v.length != 10) ||
        "Merci de saisir le nombre minimun de caratère : 10",
      validMail: (v) => /.+@.+\..+/.test(v) || "Merci de saisir un mail valide",
      minChar: (v) => v.length >= 3 || "Merci de saisir plus de 2 caratères",
      number: (v) => /[0-9]/.test(v) || "Merci de saisir que des chiffres",
    },
  }),

  computed: {
    ...mapGetters([
      "getShippingsOnline",
      "getCustomerStep3",
      "getBeneficiaryStep3",
      "getShippingStep3",
      "getCheckboxStep3",
      "getPaymentStep3",
      "getPayments"
    ]),
    shippingMethod: {
      get() {
        return this.getShippingStep3;
      },
      set(value) {
        this.setShippingStep3(value);
      },
    },
    paymentMethod: {
      get() {
        return this.getPaymentStep3;
      },
      set(value) {
        this.setPaymentStep3(value);
      },
    },
    checkbox : {
        get() {
            return this.getCheckboxStep3
        },
        set(value) {
            this.setCheckboxStep3(value)
        }
    }
  },

  mounted() {
    this.initShippingsOnline();
    this.initPayments();
    this.setFormStep3(this.$refs.formStep3);
  },

  methods: {
    ...mapActions([
      "initShippingsOnline",
      "setShippingStep3",
      "setFormStep3",
      "setBeneSameCust",
      "setCheckboxStep3",
      "setPaymentStep3",
      "initPayments"
    ]),
    validate() {
      if (this.$refs.formStep3.validate()) {
        if (this.checkbox) {
          //set beneficiary = customer
          this.setBeneSameCust();
        }
        this.$emit("goToStep4");
      }
    },
  },
};
</script>
