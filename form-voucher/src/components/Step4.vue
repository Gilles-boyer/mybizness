<template>
  <v-card class="mb-12 pb-3 white--text rounded-xl" color="primary">
    <v-card-title> Vos informations : </v-card-title>
    <v-card-text style="background-color: white; width: 80%" class="mx-auto pt-2 rounded-xl primary--text">
      <strong>Nom et Prénom :</strong>
      {{
      (
      confirmationData.client.firstName +
      " " +
      confirmationData.client.lastName
      ).toUpperCase()
      }}
      <br />
      <strong>Mail :</strong> {{ confirmationData.client.email }} <br />
      <strong>tel :</strong> {{ confirmationData.client.tel }}
    </v-card-text>

    <v-card-title> Informations du bénéficiaire : </v-card-title>

    <v-card-text style="background-color: white; width: 80%" class="mx-auto pt-2 rounded-xl primary--text">
      <strong>Nom et Prénom :</strong>
      {{
      (
      confirmationData.beneficiary.firstName +
      " " +
      confirmationData.beneficiary.lastName
      ).toUpperCase()
      }}
      <br />
      <strong>Mail :</strong> {{ confirmationData.beneficiary.email }} <br />
      <strong>tel :</strong> {{ confirmationData.beneficiary.tel }}
    </v-card-text>

    <v-card-title> Méthode d'envoie : </v-card-title>

    <v-card-text style="background-color: white; width: 80%" class="mx-auto pt-2 rounded-xl primary--text">
      {{ confirmationData.shippingMethod.label }}
    </v-card-text>

    <v-card-title> Votre personnalisation du bon: </v-card-title>
    <v-card-text style="background-color: white; width: 80%" class="mx-auto pt-2 rounded-xl primary--text">
      <strong>Message :</strong> {{ confirmationData.personalization.message }}
      <br />
      <strong>Theme :</strong>
      {{ confirmationData.personalization.theme.name }} <br />
      <strong>Couleur du bon :</strong>
      <v-icon :color="confirmationData.personalization.backgroundColor">mdi-circle</v-icon>
      <br />
      <strong>Style d'écriture :</strong>
      {{ confirmationData.personalization.fontFamily }}
    </v-card-text>

    <v-card-title> Liste des cadeaux : </v-card-title>
    <v-card-text style="background-color: white; width: 80%" class="mx-auto pt-2 rounded-xl primary--text">
      <v-card-text v-for="(gift, index) in confirmationData.giftsList" :key="index">
        <strong>Désignation:</strong> {{ gift.label }} <br>
        <strong> valeur :</strong> {{ gift.price }}€
      </v-card-text>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title> <strong>Total à payer:</strong> {{ totalGift }}€</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-card-text>
  </v-card>
</template>
<script>
export default {
  props: {
    confirmationData: {
      type: Object,
    },
  },

  computed: {
    totalGift() {
      var total = 0;

      if (this.confirmationData.giftsList.length > 0) {
        this.confirmationData.giftsList.forEach(gift => total += gift.price);
      }

      return total
    }
  }
};
</script>