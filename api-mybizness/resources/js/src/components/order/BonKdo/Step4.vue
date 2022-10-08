<template>
  <v-card class="mb-12 pb-3 white--text rounded-xl login" elevation="0">
    <v-card-title class="primary--text"> Vos informations : </v-card-title>
    <v-card-text
      style="background-color: white; width: 80%"
      class="mx-auto pt-2 rounded-xl primary--text"
    >
      <strong>Nom et Prénom :</strong>
      {{
        (
          getCustomerStep3.firstName +
          " " +
          getCustomerStep3.lastName
        ).toUpperCase()
      }}
      <br />
      <strong>Mail :</strong> {{ getCustomerStep3.email }} <br />
      <strong>tel :</strong> {{ getCustomerStep3.tel }}
    </v-card-text>

    <v-card-title class="primary--text">
      Informations du bénéficiaire :
    </v-card-title>

    <v-card-text
      style="background-color: white; width: 80%"
      class="mx-auto pt-2 rounded-xl primary--text"
    >
      <strong>Nom et Prénom :</strong>
      {{
        (
          getBeneficiaryStep3.firstName +
          " " +
          getBeneficiaryStep3.lastName
        ).toUpperCase()
      }}
      <br />
      <strong>Mail :</strong> {{ getBeneficiaryStep3.email }} <br />
      <strong>tel :</strong> {{ getBeneficiaryStep3.tel }}
    </v-card-text>

    <v-card-title class="primary--text"> Méthode d'envoie : </v-card-title>

    <v-card-text
      style="background-color: white; width: 80%"
      class="mx-auto pt-2 rounded-xl primary--text"
    >
      {{ getShippingStep3.name }}
    </v-card-text>

    <v-card-title class="primary--text">
      Votre personnalisation du bon:
    </v-card-title>
    <v-card-text
      style="background-color: white; width: 80%"
      class="mx-auto pt-2 rounded-xl primary--text"
    >
      <strong>Message :</strong> {{ getPersonalization.message }}
      <br />
      <strong>Theme :</strong>
      {{ getPersonalization.image.name }} <br />
      <strong>Couleur du bon :</strong>
      <v-icon :color="getPersonalization.color.hex">mdi-circle</v-icon>
      <br />
      <strong>Style d'écriture :</strong>
      {{ getPersonalization.font.name }}
    </v-card-text>

    <v-card-title class="primary--text"> Liste des cadeaux : </v-card-title>
    <v-card-text
      style="background-color: white; width: 80%"
      class="mx-auto pt-2 rounded-xl primary--text"
    >
      <v-card-text v-for="(gift, index) in getGifts" :key="index">
        <strong>Désignation:</strong> {{ gift.name }} <br />
        <strong> valeur :</strong> {{ gift.price }}€
      </v-card-text>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title>
            <strong>Total à payer:</strong>
            {{ getTotalGifts }}€</v-list-item-title
          >
        </v-list-item-content>
      </v-list-item>
    </v-card-text>
  </v-card>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters([
      "getGifts",
      "getTotalGifts",
      "getPersonalization",
      "getCustomerStep3",
      "getBeneficiaryStep3",
      "getShippingStep3",
    ]),
  },
};
</script>
