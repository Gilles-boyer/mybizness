<template>
  <v-app app>
    <snackbar />
    <OverlayVue />
    <Navigation v-if="authenticated" />
    <v-main style="background-color: gray">
      <router-view />
    </v-main>
  </v-app>
</template>
<script>
import Navigation from "./components/application/Navigation.vue";
import snackbar from "./components/general/SnackBar.vue";
import OverlayVue from "./components/general/Overlay.vue";
import {  mapGetters } from "vuex";

export default {
  name: "App",
  components: {
    Navigation,
    snackbar,
    OverlayVue,
  },
  data() {
    return {
      connected: false,
    };
  },
  computed: {
    ...mapGetters(['authenticated'])
  },
};
</script>
