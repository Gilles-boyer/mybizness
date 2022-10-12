<template>
    <v-container fluid class="pa-2" fill-height>
      <appBar :buttons="Buttons" :tabs="Tabs" @valueTab="setTabs($event)" />
      <card>
        <v-tabs-items v-model="Tabs">
          <v-tab-item value="Application">
            <table-app />
          </v-tab-item>
        </v-tabs-items>
      </card>
    </v-container>
  </template>


    <script>
  import appBar from "../components/application/AppBar.vue";
  import card from "../components/card/Card.vue";
  import TableApp from "../components/app/TableApp.vue";
  export default {
    data() {
      return {
        Buttons: [
          {
            label: "Liste des Applications",
            icon: "mdi-monitor",
            href: "Application",
          },
        ],
        Tabs: "Application",
      };
    },

    components: {
      card,
      appBar,
      TableApp,
    },
    methods: {
      setTabs(value) {
        this.Tabs = value;
      },
    },
  };
  </script>
