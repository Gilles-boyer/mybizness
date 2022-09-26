<template>
  <v-container fluid class="pa-2" fill-height>
    <snackbar />
    <OverlayVue />
    <v-navigation-drawer permanent app right stateless shaped color="#04153B10">
      <listClass :items="getClassMethod" />
    </v-navigation-drawer>
    <card>
        <cardScript />
    </card>
  </v-container>
</template>


<script>
import card from "../components/card/Card.vue";
import snackbar from "../components/general/SnackBar.vue";
import { mapGetters, mapActions } from "vuex";
import listClass from "../components/class/ListClass.vue";
import cardScript from "../components/script/CardScript.vue";
import OverlayVue from "../components/general/Overlay.vue";
export default {
  components: {
    listClass,
    snackbar,
    cardScript,
    card,
    OverlayVue
  },
  mounted() {
    this.openOverlay()
    this.getAllClassMethod();
  },

  data: () => ({
    items: [
      {
        id: 1,
        name: "test",
        description: "test",
        list_method: [],
      },
    ],

  }),

  methods: {
    ...mapActions(["getAllClassMethod", "openOverlay"]),
  },
  computed: {
    ...mapGetters(["getClassMethod"]),
  },
};
</script>
