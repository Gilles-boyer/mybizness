<template>
  <v-container fluid class="pa-0">
    <Tab :buttons="Buttons" :tabs="Tabs" />
  </v-container>
</template>
<script>
import Tab from "../components/global/Tab.vue";
export default {
  data() {
    return {
      Buttons: [],
      Tabs: "",
    };
  },
  name: "Home",
  components: {
    Tab,
  },
};
</script>
