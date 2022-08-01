<template>
  <v-app>
    <Navigation v-if="connected" />
    <v-main style="background-color: gray">
      <router-view />
    </v-main>
  </v-app>
</template>

<script>
import Navigation from "./components/application/Navigation.vue";
export default {
  name: "App",
  components: {
    Navigation,
  },
  data() {
    return {
      connected: true,
    };
  },
};
</script>
