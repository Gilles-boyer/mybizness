<template>
  <v-row justify="center">
    <v-dialog
      v-model="dialog"
      fullscreen
      hide-overlay
      transition="dialog-bottom-transition"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn small rounded outlined color="primary" v-bind="attrs" v-on="on">
          + Nouvelle commande
        </v-btn>
      </template>
      <overlay />
      <v-card class="full100 mx-auto login">
        <v-toolbar dark color="primary">
          <v-toolbar-title>Nouveau Bon Cadeau</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn icon dark @click="closeDialog()">
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-toolbar-items>
        </v-toolbar>

        <v-stepper v-model="e1" class="full100 mx-auto">
          <v-stepper-header>
            <v-stepper-step
              :complete="e1 > 1"
              step="1"
              color="error"
              class="font-weight-bold mx-auto"
            >
              les cadeaux
            </v-stepper-step>

            <v-divider></v-divider>

            <v-stepper-step :complete="e1 > 2" step="2" color="error">
              la personnalisation
            </v-stepper-step>

            <v-divider></v-divider>

            <v-stepper-step :complete="e1 > 3" step="3" color="error">
              le formulaire
            </v-stepper-step>
            <v-divider></v-divider>

            <v-stepper-step step="4" color="error">
              la confirmation
            </v-stepper-step>
          </v-stepper-header>

          <v-stepper-items class="mx-auto login">
            <v-stepper-content
              step="1"
              style="height: calc(110vh - 200px); overflow-y: auto"
            >
              <Step1 @goStep2="nextStep()" />
            </v-stepper-content>

            <v-stepper-content
              step="2"
              style="height: calc(129vh - 200px); overflow-y: auto"
            >
              <v-btn icon @click="backStep()">
                <v-icon dense color="primary">mdi-arrow-left-circle</v-icon>
              </v-btn>
              <Step2 @goToStep3="nextStep()" />
            </v-stepper-content>

            <v-stepper-content
              step="3"
              style="height: calc(110vh - 200px); overflow-y: auto"
            >
              <v-btn icon @click="backStep()">
                <v-icon dense color="primary">mdi-arrow-left-circle</v-icon>
              </v-btn>
              <Step3 @goToStep4="nextStep()" />
            </v-stepper-content>

            <v-stepper-content
              step="4"
              style="height: calc(110vh - 200px); overflow-y: auto"
            >
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
                  <v-icon class="mr-2">mdi-check-circle-outline</v-icon>
                  Confirmer et Payer
                  <v-icon class="ml-2">mdi-cash</v-icon>
                </v-btn>
              </v-row>
              <Step4 />
            </v-stepper-content>
          </v-stepper-items>
        </v-stepper>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import Step1 from "./BonKdo/Step1.vue";
import Step2 from "./BonKdo/Step2.vue";
import Step3 from "./BonKdo/Step3.vue";
import Step4 from "./BonKdo/Step4.vue";
import { mapGetters, mapActions } from "vuex";
import overlay from "../general/Overlay.vue";
export default {
  computed: {
    ...mapGetters([
      "getResetStep2",
      "getGiftsId",
      "getTotalGifts",
      "getPersonalization",
      "getCustomerStep3",
      "getBeneficiaryStep3",
      "getShippingStep3",
      "getPaymentStep3"
    ]),
  },
  data() {
    return {
      dialog: false,
      clearGiftStep1: "",
      notifications: false,
      sound: true,
      widgets: false,
      e1: 1,
    };
  },
  components: {
    Step1,
    Step2,
    Step3,
    Step4,
    overlay,
  },
  methods: {
    ...mapActions([
      "clearPersonalization",
      "clearGifts",
      "clearPersonalization",
      "resetCatStep1",
      "clearFormStep3",
      "newOrders"
    ]),
    nextStep() {
      this.e1++;
    },
    backStep() {
      this.e1--;
    },
    closeDialog() {
      this.resetCatStep1();
      this.clearGifts();
      this.clearPersonalization();
      this.clearFormStep3();
      this.e1 = 1;
      this.dialog = false;
    },
    confirmationAndPaiement() {
      var data = {
        id:2,
        customer: this.getCustomerStep3,
        beneficiary: this.getBeneficiaryStep3,
        personalization: {
          color: this.getPersonalization.color.id,
          font: this.getPersonalization.font.id,
          image: this.getPersonalization.image.id,
          message: this.getPersonalization.message,
        },
        gifts: this.getGiftsId,
        shipping: this.getShippingStep3.id,
        payment: this.getPaymentStep3.id,
        total: this.getTotalGifts,
      };
      console.log(data);
      //this.newOrders(data);
    },
  },
};
</script>
