<template>
  <v-container fill-height fluid align-center justify-center>
    <v-stepper v-model="e1" width="90%" class="f100">
      <v-stepper-header>
        <v-stepper-step :complete="e1 > 1" step="1" color="error" class="font-weight-bold">
          Je choisis mes cadeaux
        </v-stepper-step>

        <v-divider></v-divider>

        <v-stepper-step :complete="e1 > 2" step="2" color="error">
          Je personnalise mon bon
        </v-stepper-step>

        <v-divider></v-divider>

        <v-stepper-step :complete="e1 > 3" step="3" color="error">
          Je complete le formulaire d'achat
        </v-stepper-step>
        <v-divider></v-divider>

        <v-stepper-step step="4" color="error">
          Je paye mon Bon Cadeau
        </v-stepper-step>
      </v-stepper-header>

      <v-stepper-items>
        <v-stepper-content step="1">
          <Step1 @listGifts="addListGifts($event)" />
        </v-stepper-content>

        <v-stepper-content step="2">
          <v-btn icon @click="backStep()">
            <v-icon dense color="primary">mdi-arrow-left-circle</v-icon>
          </v-btn>
          <Step2 @dataPersonalization="addPersonalization($event)" />
        </v-stepper-content>

        <v-stepper-content step="3">
          <v-btn icon @click="backStep()">
            <v-icon dense color="primary">mdi-arrow-left-circle</v-icon>
          </v-btn>
          <Step3 @dataForm="addDataForm($event)" />
        </v-stepper-content>
        <v-stepper-content step="4">
          <v-btn icon @click="backStep()">
            <v-icon dense color="primary">mdi-arrow-left-circle</v-icon>
          </v-btn>
          <v-row justify="center" align="center" class="pa-4">
            <v-btn color="primary" class="mx-auto" @click="confirmationAndPaiement()" block>
              <v-icon class="mr-2">mdi-check-circle-outline</v-icon> Confirmer
              et Payer
              <v-icon class="ml-2">mdi-cash</v-icon>
            </v-btn>
          </v-row>
          <Step4 :confirmationData="voucher" />
          <v-row justify="center" align="center" class="pa-4">
            <v-btn color="primary" class="mx-auto" @click="confirmationAndPaiement()" block>
              <v-icon class="mr-2">mdi-check-circle-outline</v-icon> Confirmer
              et Payer
              <v-icon class="ml-2">mdi-cash</v-icon>
            </v-btn>
            <form style="position: absolute; top: -999px; left: -999px;" id="f_form91486208" action="https://cte.vosfactures.fr/payments" method="post"></form>
          </v-row>
        </v-stepper-content>
      </v-stepper-items>
    </v-stepper>
  </v-container>
</template>

<script>
import Step1 from "../components/Step1.vue";
import Step2 from "../components/Step2.vue";
import Step3 from "../components/Step3.vue";
import Step4 from "../components/Step4.vue";
export default {
  methods: {
    addListGifts(list) {
      this.voucher.giftsList = list;
      this.nextStep();
    },
    addPersonalization(data) {
      this.voucher.personalization = data;
      this.nextStep();
    },
    addDataForm(data) {
      this.voucher.client = data.client;
      this.voucher.beneficiary = data.beneficiary;
      this.voucher.shippingMethod = data.shippingMethod;
      this.nextStep();
    },
    confirmationAndPaiement() {
      var form = document.getElementById("f_form91486208");
      var tabIdGift = [];
      //select gift id only for api
      this.voucher.giftsList.forEach(element => tabIdGift.push(element.id))
      //request by form method post
      form.innerHTML += `<input type="text" name="payment[kind]" value="autopayment"/>`;
      form.innerHTML += `<input type="text" name="payment[account_id]" value="598713"/>`;
      form.innerHTML += `<input type="text" name="payment[name]" value="bon cadeau"/>`;
      form.innerHTML += `<input type="text" name="payment[product_id]" value="91486208"/>`;
      form.innerHTML += `<input type="text" name="payment[provider]" value="stripe"/>`;
      form.innerHTML += `<input type="text" name="payment[referrer]" value="https://cte.vosfactures.fr/"/>`;
      form.innerHTML += `<input type="text" name="payment[generate_invoice]" value="1"/>`;
      form.innerHTML += `<input type="text" name="lang" value="fr"/>`;
      form.innerHTML += `<input type="text" name="payment[first_name]" value="${this.voucher.client.firstName}"/>`;
      form.innerHTML += `<input type="text" name="payment[last_name]" value="${this.voucher.client.lastName}"/>`;
      form.innerHTML += `<input type="text" name="payment[email]" value="${this.voucher.client.email}"/>`;
      form.innerHTML += `<input type="text" name="payment[phone]" value="${this.voucher.client.tel}"/>`;
      form.innerHTML += `<input type="text" name="payment[price" value="${this.total.toString()}"/>`;
      form.innerHTML += `<input type="text" name="payment[field1]" value='${JSON.stringify(this.voucher.beneficiary)}'/>`;
      form.innerHTML += `<input type="text" name="payment[field2]" value='${JSON.stringify(this.voucher.personalization)}'/>`;
      form.innerHTML += `<input type="text" name="payment[field3]" value='${JSON.stringify(this.voucher.shippingMethod)}'/>`;
      form.innerHTML += `<input type="text" name="payment[field4]" value='${JSON.stringify(tabIdGift)}'/>`;
      form.submit();
    },
    nextStep() {
      this.e1++;
    },
    backStep() {
      this.e1--;
    },
  },
  data() {
    return {
      e1: 1,
      voucher: {
        client: {
          firstName: "",
          lastName: "",
        },
        beneficiary: {
          firstName: "",
          lastName: "",
        },
        shippingMethod: {
          label: "",
        },
        personalization: {
          message: "",
          theme: "",
        },
        giftsList: [],
      },
    };
  },
  name: "BonCadeau",
  components: {
    Step1,
    Step2,
    Step3,
    Step4,
  },
  computed: {
    total() {
      var totalGift = 0;
      if (this.voucher.giftsList.length > 0) {
        this.voucher.giftsList.forEach((gift) => (totalGift += gift.price));
      }
      return totalGift;
    },
  },
};
</script>