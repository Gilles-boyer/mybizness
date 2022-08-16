<template>
  <v-container fluid class="pa-0" fill-height>
    <Tab
      :buttons="Buttons"
      :tabs="Tabs"
      @valueTab="setTabs($event)"
      v-if="selectCircuit"
    />
    <v-tabs-items v-model="Tabs" style="background-color: grey" class="full100">
      <v-tab-item value="Circuit" class="pa-2 full100">
        <v-card class="pa-1 login full100" shaped>
          <ListCircuit v-if="!selectCircuit" @select="SelectCircuit($event)" />
          <ListDayCircuitOpen v-if="selectCircuit" />
        </v-card>
      </v-tab-item>

      <v-tab-item value="ParameterCircuit">
        <v-card class="pa-2 login">
          <v-card flat>
            <v-card-text> Gilles boyer 2</v-card-text>
          </v-card>
        </v-card>
      </v-tab-item>
    </v-tabs-items>
  </v-container>
</template>
<script>
import Tab from "../components/global/Tab.vue";
import ListCircuit from "../components/service/circuit/ListCircuit.vue";
import ListDayCircuitOpen from "../components/service/circuit/ListDayCircuitOpen.vue";
export default {
  data() {
    return {
      Buttons: [
        {
          label: "Liste des circuits karting",
          icon: "mdi-racing-helmet",
          href: "Circuit",
        },
        {
          label: "Parametre du circuit",
          icon: "mdi-cog",
          href: "ParameterCircuit",
        },
      ],
      Tabs: "Circuit",
      selectCircuit: "",
    };
  },
  name: "Circuit",
  components: {
    Tab,
    ListCircuit,
    ListDayCircuitOpen,
  },
  methods: {
    setTabs(value) {
      this.Tabs = value;
    },
    SelectCircuit(circuit) {
      this.selectCircuit = circuit;
    },
  },
};
</script>