<template>
  <v-container fill-height fluid align-center justify-center>
    <v-stepper v-model="e1" width="90%" class="f100">
      <v-stepper-header>
        <v-stepper-step
          :complete="e1 > 1"
          step="1"
          color="error"
          class="font-weight-bold"
        >
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
            <v-btn
              color="primary"
              class="mx-auto"
              @click="confirmationAndPaiement()"
              block
            >
              <v-icon class="mr-2">mdi-check-circle-outline</v-icon> Confirmer
              et Payer
              <v-icon class="ml-2">mdi-cash</v-icon>
            </v-btn>
          </v-row>
          <Step4 :confirmationData="voucher" />
          <v-row justify="center" align="center" class="pa-4">
            <v-btn
              color="primary"
              class="mx-auto"
              @click="confirmationAndPaiement()"
              block
            >
              <v-icon class="mr-2">mdi-check-circle-outline</v-icon> Confirmer
              et Payer
              <v-icon class="ml-2">mdi-cash</v-icon>
            </v-btn>
            <form
              id="f_form91486208"
              class="f_form horizontal"
              autocomplete="off"
              action="https://cte.vosfactures.fr/payments"
              accept-charset="UTF-8"
              method="post"
            >
              <input
                type="hidden"
                name="authenticity_token"
                value="c7cO6VxxIgxiPZMP4DP5zFZ9BBmgOURk4WBaXFhIKh2T+/rkDKb5jL1fjxk7f6GNW3lK8HeuXbfCHDSUUhC1+g=="
              /><input
                type="hidden"
                value="trdsfgdqgdggsfdgfd"
                name="payment[description]"
                id="payment_description"
              />
              <input
                value="autopayment"
                type="hidden"
                name="payment[kind]"
                id="payment_kind"
              />
              <input
                id="f_oid91486208"
                class="f_oid"
                type="hidden"
                name="payment[oid]"
                value=""
              />
              <input type="hidden" name="payment[field1]" id="payment_field1" />
              <input type="hidden" name="payment[field2]" id="payment_field2" />
              <input type="hidden" name="payment[field3]" id="payment_field3" />
              <input type="hidden" name="payment[field4]" id="payment_field4" />
              <input type="hidden" name="payment[field5]" id="payment_field5" />
              <input type="hidden" name="lang" id="lang" value="fr" /><input
                type="hidden"
                value="598713"
                name="payment[account_id]"
                id="payment_account_id"
              />
              <input
                type="hidden"
                value="test gilles"
                name="payment[name]"
                id="payment_name"
              />
              <input
                type="hidden"
                value="91486208"
                name="payment[product_id]"
                id="payment_product_id"
              />
              <input
                type="hidden"
                name="payment[department_id]"
                id="payment_department_id"
              />
              <input
                type="hidden"
                name="payment[invoice_id]"
                id="payment_invoice_id"
              />
              <input
                type="hidden"
                value="https://cte.vosfactures.fr/"
                name="payment[referrer]"
                id="payment_referrer"
              />
              <input
                type="hidden"
                name="payment[additional_discount]"
                id="payment_additional_discount"
              />
            </form>
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
import paiement from "../services/paiement";
export default {
  methods: {
    addListGifts(list) {
      this.voucher.giftsList = list;
      console.log(this.voucher);
      this.nextStep();
    },
    addPersonalization(data) {
      this.voucher.personalization = data;
      console.log(this.voucher);
      this.nextStep();
    },
    addDataForm(data) {
      this.voucher.client = data.client;
      this.voucher.beneficiary = data.beneficiary;
      this.voucher.shippingMethod = data.shippingMethod;
      console.log(this.voucher);
      this.nextStep();
    },
    confirmationAndPaiement() {
      var form = document.getElementById("f_form91486208");

      test.innerHTML += `<input type="text" name="payment[first_name]" value="${this.voucher.client.firstName}"/>`;
      test.innerHTML += `<input type="text" name="payment[last_name]" value="${this.voucher.client.lastName}"/>`;
      test.innerHTML += `<input type="text" name="payment[payment_email]" value="${this.voucher.client.email}"/>`;
      test.innerHTML += `<input type="text" name="payment[phone]" value="${this.voucher.client.tel}"/>`;
      test.innerHTML += `<input type="text" name="payment[price]" value="${this.total}"/>`;
      test.innerHTML += `<input type="text" name="payment[description]" value="${JSON.stringify(this.voucher)}"/>`;

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
      e1: 4,
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
    total(){
      var totalGift = 0
      if(this.voucher.giftsList.length > 0 ){
         this.voucher.giftsList.forEach(gift => totalGift += gift.price);
      }
      return total;
    }
  }
};
</script>