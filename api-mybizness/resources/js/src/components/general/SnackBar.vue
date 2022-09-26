<template>
  <v-snackbar
    v-model="getSnackData.snackbar"
    :timeout="getSnackData.timeout"
    :color="getSnackData.color"
  >
    {{ getSnackData.text }}

    <template v-slot:action="{ attrs }">
      <v-btn
        color="blue"
        text
        v-bind="attrs"
        @click="getSnackData.snackbar = false"
      >
        Close
      </v-btn>
    </template>
  </v-snackbar>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  methods: {
    ...mapActions(["openSnack"]),
  },
  computed: {
    ...mapGetters(["getSnackData"]),
  },
};
</script>
