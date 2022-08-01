import packages from "../../../../package.json";

export default {
  name: "Navigation",
  data() {
    return {
      user: {
        name: "Gilles BOYER",
      },
      drawer: true,
      appName: packages.name,
      version: packages.version,
      dateProd: packages.date,
      items: [
        { title: "Dashboard", icon: "mdi-view-dashboard", to: "/" },
        { title: "Bon Cadeau", icon: "mdi-gift", to: "/gift" },
      ],
      mini: true,
    };
  },
  computed: {
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

          default:
            return 0;
            break;
        }
      },
      set: function (value) {},
    },
  },
  methods: {},
};
