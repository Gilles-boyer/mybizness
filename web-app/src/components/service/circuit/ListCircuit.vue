 <template>
  <v-card flat shaped class="full100 pa-2">
    <v-toolbar elevation="0" class="mb-4">
      <AddOrModifyCircuit
        @createCircuit="addCircuit($event)"
        :Modify="modify"
        @closeModal="closeModal()"
        :itemSelected="itemModified"
        @updateCircuit="UpdateCircuit($event)"
      />
    </v-toolbar>

    <v-row align-content="center" justify="center">
      <v-col
        cols="11"
        sm="6"
        md="3"
        xl="3"
        v-for="(circuit, index) in listCircuit"
        :key="index"
      >
        <v-card class="mx-auto" max-width="400" shaped>
          <v-img
            class="white--text align-end"
            height="200px"
            src="https://soubik.reunion.fr/uploads/media/etablissement/0001/22/thumb_21394_etablissement_large.jpeg"
          >
            <v-card-title>{{ circuit.name }}</v-card-title>
          </v-img>

          <v-card-subtitle class="pb-0"> id: {{ circuit.id }}</v-card-subtitle>

          <v-card-text class="text--primary">
            <div class="font-weight-bold primary--text">
              Ouvert de {{ circuit.open }} à {{ circuit.close }}
            </div>
          </v-card-text>

          <v-card-actions>
            <v-btn color="primary" @click="SelectCircuit(circuit)" text>
              ouvrir
            </v-btn>
            <v-btn color="grey" @click="modifyCircuit(circuit, index)" text>
              Modifier
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-card>
</template> 

<script>
import CircuitBdd from "../../../data/circuit.json";
import AddOrModifyCircuit from "./modal/AddOrModifyCircuit.vue";

export default {
  created() {
    this.init();
  },
  methods: {
    SelectCircuit(item) {
      this.$emit("select", item);
    },
    init() {
      this.listCircuit = CircuitBdd;
    },
    addCircuit(circuit) {
      this.listCircuit.push(circuit);
    },
    modifyCircuit(circuit, index) {
      this.modify = true;
      this.indexItem = index;
      this.itemModified = circuit;
    },
    closeModal() {
      this.itemModified = {};
      this.modify = false;
    },
    UpdateCircuit(circuit) {
      this.listCircuit[this.indexItem] = circuit;
    },
  },
  data() {
    return {
      listCircuit: [],
      editedIndex: -1,
      modify: false,
      itemModified: {},
      indexItem: 0,
    };
  },
  components: {
    AddOrModifyCircuit,
  },
};
</script>