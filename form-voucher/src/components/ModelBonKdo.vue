<template>
  <v-card :style="fontFamily" class="rounded-xl white--text mt-4 mb-4" :color="background">
    <v-row justify="center" align-content="center" class="f100 pa-2">
      <v-col cols="3">
        <v-img :aspect-ratio="sizeImg" style="border-radius: 25px" :src="themeGift.img"></v-img>
      </v-col>
      <v-col cols="9">
        <v-row align="stretch" justify="space-between" align-content="space-between" class="f100">
          <v-col cols="12">
            <v-row justify="space-between" align-content="space-between">
              <v-col cols="9" class="pa-0">
                <v-card-title class="
                    text-caption text-sm-caption text-md-h6 text-xl-h6
                    pa-2
                  ">Bon Cadeau N°123456789
                  <!--ID here-->
                </v-card-title>
                <v-card-text class="
                    text-caption
                    text-sm-caption
                    text-md-subtitle-2
                    text-xl-subtitle-2
                    px-2
                    py-0
                  ">
                  Félicitation Xxxxxxxx,
                  <!--Prénom du bénéficiaire-->
                </v-card-text>
              </v-col>
              <v-col cols="3">
                <v-img alt="CFG logo" :src="url+'/public/logo.svg'"  />
              </v-col>
            </v-row>
          </v-col>
          <v-col cols="6" class="pa-0">
            <v-card-text class="
                text-caption
                text-sm-caption
                text-md-subtitle-2
                text-xl-subtitle-2
                px-2
                py-0
              ">
              Nous avons le plaisir de vous acceuillir pour :
            </v-card-text>
            <v-card color="white" class="rounded-xl primary--text text-center" width="100%" min-height="50px"
              elevation="0">
              <v-list-item>
                <v-list-item-content>
                  <v-list-item-title>Produit 1</v-list-item-title>
                  <v-list-item-title>Produit 2</v-list-item-title>
                  <v-list-item-title>Produit 3</v-list-item-title>
                  <v-list-item-title>Produit 4</v-list-item-title>
                  <v-list-item-title>Produit 5</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-card>
            <v-spacer></v-spacer>
            <v-card-text class="
                text-caption
                text-sm-caption
                text-md-subtitle-2
                text-xl-subtitle-2
                px-2
                py-0
              ">
              Votre bon est valide jusqu'au :
            </v-card-text>
            <v-card elevation="0" color="white" class="rounded-xl" width="100%" min-height="30px">
              <v-card-text class="text-center primary--text">12-12-2022</v-card-text>
            </v-card>
          </v-col>
          <v-col cols="6" class="pa-0">
            <v-row align="center" justify="center">
              <v-col cols="11">
                <v-img class="ml-auto" width="80"
                  src="data:image/png;base64,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">
                </v-img>
              </v-col>
              <v-col cols="11">
                <v-card elevation="0" color="white" class="rounded-xl primary--text text-center" width="100%"
                  min-height="100">
                  <v-card-text>
                    {{ messageGift }}
                  </v-card-text>
                </v-card>
              </v-col>
            </v-row>
          </v-col>
          <v-col cols="11">
            <v-row justify="center" class="pb-0">
              <v-col cols="12" class="text-sm-caption">
                Pour profiter de votre cadeau, Réservez vite au 0692 725 584
                <v-row justify="center" align="center" class="text-center">
                  <v-divider class="mr-3" color="white"></v-divider>
                  www.cfg.re
                </v-row>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-card>
</template>

<script>
   import urlBase from "../data/urlBase.json"
export default {
  props: {
    background: {
      default: "primary",
      type: String,
    },
    messageGift: {
      default: "Votre Message",
      type: String,
    },
    fontGift: {
      default: "Roboto",
      type: String,
    },
    themeGift: {
      type: Object,
    },
  },
  data: () => ({
    widthScreenSize: window.innerWidth,
    url: urlBase.base,
  }),
  methods: {
    myEventHandler(e) {
      this.widthScreenSize = window.innerWidth;
    },
  },
  computed: {
    sizeImg() {
      switch (true) {
        case this.widthScreenSize <= 800:
          return 3 / 8;
        case this.widthScreenSize <= 900:
          return 3 / 7;
        case this.widthScreenSize <= 958:
          return 4 / 8;
        case this.widthScreenSize <= 1100:
          return 3 / 9;
        case this.widthScreenSize <= 1200:
          return 3 / 8;
        case this.widthScreenSize <= 1300:
          return 3 / 7;
        case this.widthScreenSize <= 1500:
          return 3 / 6;
        case this.widthScreenSize <= 1700:
          return 3 / 5;
        default:
          return 5 / 7;
      }
    },
    fontFamily() {
      return `font-family: ${this.fontGift} , sans-serif;`;
    },
  },
  created() {
    window.addEventListener("resize", this.myEventHandler);
  },
};
</script>