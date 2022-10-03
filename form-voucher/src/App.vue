
<template>
  <v-app>
    <v-app-bar app color="primary" dark absolute>
      <div class="d-flex align-center">
        <v-btn text href="https://www.cfg.re/">
          <v-img alt="CFG logo" class="shrink mr-2" contain :src="url+'/public/logo.svg'" transition="scale-transition"
            width="70" />
        </v-btn>
      </div>

      <v-spacer></v-spacer>

      <v-btn href="/" text>
        <span class="mr-2"></span>
        <v-icon>mdi-gift</v-icon>
        <span class="mr-2"></span>
        SOLUTION BON CADEAU
      </v-btn>
    </v-app-bar>

    <v-main>
      <router-view />
    </v-main>
    <v-footer padle>
      <v-row justify="center">
        <v-col class="text-center primary--text text-overline ma-0 pa-0" cols="12">
          {{ new Date().getFullYear() }} - CFG
        </v-col>
        <v-btn color="primary" class="mb-2" text rounded small>
          <v-icon small> mdi-phone </v-icon>
          0692 725 584
        </v-btn>
        <v-btn color="primary" class="mb-2" text rounded small>
          <v-icon small> mdi-email </v-icon>
          CONTACT
        </v-btn>
      </v-row>
    </v-footer>
  </v-app>
</template>

<script>
  import urlBase from "./data/urlBase.json"
export default {
  name: 'App',
  data: () => ({
    url: urlBase.base,
  })
}
</script>
