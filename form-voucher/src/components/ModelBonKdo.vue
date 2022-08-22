<template>
  <v-card class="rounded-xl white--text mt-4" color="primary" height="400">
    <v-row justify="center" align-content="center" class="f100 pa-2">
      <v-col cols="3">
        <v-img
          :aspect-ratio="5 / 7"
          style="border-radius: 25px"
          src="https://cdn.vuetifyjs.com/images/cards/cooking.png"
        ></v-img>
      </v-col>
      <v-col cols="9">
        <v-row
          align="stretch"
          justify="space-between"
          align-content="space-between"
          class="f100"
        >
          <v-col cols="12">
            <v-row justify="space-between" align-content="space-between">
              <v-col cols="9" class="pa-0">
                <v-card-title
                  class="
                    text-caption text-sm-caption text-md-h6 text-xl-h6
                    pa-2
                  "
                  >Bon Cadeau N°123456789
                  <!--ID here-->
                </v-card-title>
                <v-card-text
                  class="
                    text-caption
                    text-sm-caption
                    text-md-subtitle-2
                    text-xl-subtitle-2
                    px-2
                    py-0
                  "
                >
                  Félicitation Xxxxxxxx,
                  <!--Prénom du bénéficiaire-->
                </v-card-text>
              </v-col>
              <v-col cols="3">
                <v-img
                  alt="CFG logo"
                  src="https://gilles-boyer.github.io/mybizness/form-voucher/dist/logo.svg"
                  :aspect-ratio="13 / 6"
                />
              </v-col>
            </v-row>
          </v-col>
          <v-col cols="6" class="pa-0">
            <v-card-text
              class="
                text-caption
                text-sm-caption
                text-md-subtitle-2
                text-xl-subtitle-2
                px-2
                py-0
              "
            >
              Nous avons le plaisir de vous acceuillir pour :
            </v-card-text>
            <v-card
              color="white"
              class="rounded-xl primary--text"
              width="100%"
              min-height="50px"
            >
            </v-card>
            <v-spacer></v-spacer>
            <v-card-text
              class="
                text-caption
                text-sm-caption
                text-md-subtitle-2
                text-xl-subtitle-2
                px-2
                py-0
              "
            >
              Votre bon est valide jusqu'au :
            </v-card-text>
            <v-card
              color="white"
              class="rounded-xl primary--text"
              width="100%"
              min-height="30px"
            >
            </v-card>
          </v-col>
          <v-col cols="12">
            <v-row justify="center" class="text-center pb-0" align="end">
              <v-col cols="10" class="pb-0">
                Réservez vite pour profiter de votre cadeau 0692 725 584
                <v-divider color="white"></v-divider>
              </v-col>
              <v-col cols="2" class="pb-0">www.cfg.re</v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-card>
</template>