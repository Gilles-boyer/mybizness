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
          <Step2 />

          <v-btn color="primary" @click="e1 = 3"> Continue </v-btn>

          <v-btn text> Cancel </v-btn>
        </v-stepper-content>

        <v-stepper-content step="3">
          <v-card class="mb-12" color="grey lighten-1" height="200px"></v-card>

          <v-btn color="primary" @click="e1 = 4"> Continue </v-btn>

          <v-btn text> Cancel </v-btn>
        </v-stepper-content>
        <v-stepper-content step="4">
          <v-card class="mb-12" color="grey lighten-1" height="200px"></v-card>

          <v-btn color="primary" @click="e1 = 1"> Continue </v-btn>

          <v-btn text> Cancel </v-btn>
        </v-stepper-content>
      </v-stepper-items>
    </v-stepper>
  </v-container>
</template>

<script>
import Step1 from "../components/Step1.vue";
import Step2 from "../components/Step2.vue";
export default {
  methods: {
    addListGifts(list) {
      this.voucher.giftsList = list;
      console.log(this.voucher);
      this.e1++;
    },
  },
  data() {
    return {
      e1: 2,
      voucher: {},
    };
  },
  name: "BonCadeau",
  components: {
    Step1,
    Step2,
  },
};
</script>