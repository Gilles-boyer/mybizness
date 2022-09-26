<template>
  <v-list color="#FFFFFF80">
    <!-- overlay -->
    <v-overlay :value="overlay">
      <v-progress-circular indeterminate size="64"></v-progress-circular>
    </v-overlay>

    <!-- modal -->
    <v-list-item class="mx-auto">
      <v-btn color="#04153B80" rounded class="mx-auto" @click="openAddScript()">
        <v-icon small class="mr-1">mdi-plus</v-icon>
        Ajouter un Script
      </v-btn>
      <modalAddScript />
    </v-list-item>

    <!-- list -->
    <v-list-group
      v-for="(item, i) in getScripts"
      :key="item.id"
      v-model="item.active"
      prepend-icon="mdi-folder"
      no-action
      @change="selectScript(item, i)"
    >
      <template v-slot:activator>
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-row
              justify="space-between"
              align="center"
              v-bind="attrs"
              v-on="on"
            >
              <v-col cols="9">
                <v-list-item-title
                  class="font-weight-medium"
                  v-text="item.name"
                ></v-list-item-title>
              </v-col>
              <v-col cols="1">
                <v-btn
                  icon
                  color="primary"
                  @click="deleteScript(item.id, i, item.name)"
                >
                  <v-icon>mdi-delete-empty</v-icon>
                </v-btn>
              </v-col>
            </v-row>
          </template>
          <span>{{ item.description }}</span>
        </v-tooltip>
      </template>

      <!-- draggable -->
      <drag v-model="elements" />
    </v-list-group>
  </v-list>
</template>
<script>
import drag from "../draggable/Drag.vue";
import { mapGetters, mapActions } from "vuex";
import modalAddScript from "./ModalAddScript.vue";
import apiScript from "../../services/axios/script";
export default {
  name: "list-script",
  components: {
    modalAddScript,
    drag,
  },

  data: () => ({
    overlay: false,
  }),

  methods: {
    selectScript(item) {
      this.openOverlay();
      this.setSelectedScript(item);
      this.setElements(item.id);
    },
    deleteScript(scriptId, index, name) {
      if (confirm(`Voulez vous vraiment supprimer le script ${name} ?`)) {
        apiScript
          .deleteScript(scriptId)
          .then((res) => {
            this.getScripts.splice(index, 1);
            this.openSnack({
              message: res.data.message,
              color: "success",
            });
          })
          .catch((err) => {
            this.openSnack({
              text: err.toString(),
              color: "error",
            });
          });
      }
    },
    openAddScript() {
      this.openScriptDialog({ title: "Ajouter un script" });
    },
    ...mapActions([
      "openScriptDialog",
      "loadAllScript",
      "openSnack",
      "setSelectedScript",
      "setElements",
      "updateElements",
      "openOverlay",
    ]),
  },
  computed: {
    ...mapGetters(["getScripts", "getListMethod"]),
    elements: {
      get() {
        return this.getListMethod;
      },
      set(value) {
        this.updateElements(value);
      },
    },
  },
  mounted() {
    this.loadAllScript();
  },
};
</script>
