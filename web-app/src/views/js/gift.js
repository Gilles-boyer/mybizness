import Tab from "../../components/global/Tab.vue";
import ListGift from "../../components/service/gift/ListGift.vue";
export default {
  data() {
    return {
      Buttons: [
        {
          label: "Liste des bons cadeau",
          icon: "mdi-gift-open",
          href: "Gift",
        },
        {
          label: "Liste des Clients",
          icon: "mdi-account",
          href: "Client",
        },
      ],
      Tabs: "Gift",
    };
  },
  name: "Gift",
  components: {
    Tab,
    ListGift,
  },
  methods: {
    setTabs(value) {
      this.Tabs = value;
    },
  },
};