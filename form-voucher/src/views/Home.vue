<template>
  <v-container class="home mb-2 pt-5" fill-height fluid align-center justify-center>
    <v-row class="text-center pa-0 ma-0 f100">
      <v-col cols="12" class="text-h5 text--primary font-weight-bold">
        Votre solution Bon Cadeau CFG
      </v-col>
      <v-col cols="12">
        <Notice />
      </v-col>
      <v-col cols="12">
        <v-btn color="primary" rounded elevation="10" to="/boncadeau">
          COMMENCER
        </v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
// @ is an alias to /src
import Notice from "@/components/Notice.vue";
export default {
  name: "Home",
  components: {
    Notice,
  },
  mounted() { },
};
</script>
