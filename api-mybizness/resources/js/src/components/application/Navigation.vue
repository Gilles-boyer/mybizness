<template>
  <v-navigation-drawer
    color="primary"
    v-model="drawer"
    :mini-variant.sync="mini"
    permanent
    expand-on-hover
    app
    class="mx-auto"
  >
    <v-list-item class="px-0">
      <v-list-item-avatar class="mx-auto" rounded>
        <v-img src="/assets/logo100x100.png"></v-img>
      </v-list-item-avatar>
    </v-list-item>

    <v-list-item v-if="!mini" class="px-0">
      <v-list-item-title class="white--text text-center">
        {{ appName }}
      </v-list-item-title>
    </v-list-item>

    <v-divider color="white"></v-divider>

    <v-list-item class="px-0">
      <v-list-item-avatar class="mx-auto" color="white">
        <v-icon size="40" class="mx-auto" color="primary">mdi-account</v-icon>
      </v-list-item-avatar>
    </v-list-item>

    <v-list-item v-if="!mini" class="px-0">
      <v-list-item-title class="white--text text-center">
        {{ user.name }}
      </v-list-item-title>
    </v-list-item>

    <v-list-item v-if="!mini" class="px-0">
      <v-list-item-icon class="mx-auto">
        <v-btn icon
          ><v-icon color="white" class="mx-2">mdi-account</v-icon></v-btn
        >
        <v-btn icon
          ><v-icon color="white" class="mx-2" @click="logout()">mdi-logout</v-icon></v-btn
        >
      </v-list-item-icon>
    </v-list-item>

    <v-divider color="white"></v-divider>

    <v-list dense>
      <v-list-item-group v-model="selectedItem" color="white">
        <v-list-item v-for="item in items" :key="item.title" link :to="item.to">
          <v-list-item-icon>
            <v-icon color="white">{{ item.icon }}</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="white--text">
              {{ item.title }}
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
    </v-list>

    <template v-slot:append v-if="!mini">
      <v-list-item v-if="!mini" class="px-0">
        <span class="white--text mx-auto">
          {{ appName }}
          V{{ version }} -
          {{ dateProd }}
        </span>
      </v-list-item>
    </template>
  </v-navigation-drawer>
</template>
  <script >
import data from "../../../../../package.json";
import {mapActions, mapGetters} from "vuex"

export default {
  name: "Navigation",
  data() {
    return {
      drawer: true,
      appName: data.name,
      version: data.version,
      dateProd: data.date,
      items: [
        { title: "Bon Cadeau", icon: "mdi-gift", to: "/order" },
        { title: "Utilisateur", icon: "mdi-account", to: "/user" },
        {
          title: "Application",
          icon: "mdi-monitor-screenshot",
          to: "/application",
        },
        { title: "Script", icon: "mdi-folder", to: "/script" },
      ],
      mini: true,
    };
  },
  computed: {
    ...mapGetters(['user']),
    selectedItem: {
      get: function () {
        var route = this.$router.history.current.name;
        switch (route) {
          case "Home":
            return 0;
            break;

          case "Gift":
            return 1;
            break;

          case "User":
            return 2;
            break;
          case "Application":
            return 3;
            break;

          default:
            return 0;
            break;
        }
      },
      set: function (value) {},
    },
  },
  methods: {
    ...mapActions(['logout']),
  },
};
</script>
