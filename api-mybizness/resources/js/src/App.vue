<template>
  <v-app app>
    <snackbar />
    <Navigation v-if="connected" />
    <v-main style="background-color: gray">
      <router-view />
    </v-main>
  </v-app>
</template>
<script>
import Navigation from "./components/application/Navigation.vue";
import snackbar from "./components/general/SnackBar.vue";
import OverlayVue from "./components/general/Overlay.vue";
export default {
  name: "App",
  components: {
    Navigation,
    snackbar,
    OverlayVue,
  },
  data() {
    return {
      connected: true,
    };
  },
};
</script>
