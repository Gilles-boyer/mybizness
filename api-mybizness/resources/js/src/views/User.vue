<template>
    <v-container fluid class="pa-2" fill-height>
      <appBar :buttons="Buttons" :tabs="Tabs" @valueTab="setTabs($event)" />
      <card>
        <v-tabs-items v-model="Tabs">
          <v-tab-item value="User">
            <table-user />
          </v-tab-item>
          <v-tab-item value="Role">
            <table-role />
          </v-tab-item>
        </v-tabs-items>
      </card>
    </v-container>
  </template>


    <script>
  import appBar from "../components/application/AppBar.vue";
  import card from "../components/card/Card.vue";
  import TableUser from "../components/user/TableUser.vue";
  import TableRole from "../components/role/TableRole.vue";
  export default {
    data() {
      return {
        Buttons: [
          {
            label: "Liste des Utilisateurs",
            icon: "mdi-account",
            href: "User",
          },
          {
            label: "Liste des Roles",
            icon: "mdi-tag",
            href: "Role",
          },
        ],
        Tabs: "User",
      };
    },

    components: {
      card,
      appBar,
      TableUser,
      TableRole
    },
    methods: {
      setTabs(value) {
        this.Tabs = value;
      },
    },
  };
  </script>
