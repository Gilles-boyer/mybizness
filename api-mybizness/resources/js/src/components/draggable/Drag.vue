<style scoped>
.item-sub {
  margin: 0 0 0 1rem;
}
</style>

<template>
  <draggable
    group="function"
    @change="log"
    v-bind="dragOptions"
    tag="div"
    :list="list"
    :value="value"
    @input="emitter"
  >
    <v-list-group
      v-for="(child, index) in realValue"
      :key="index"
      v-model="child.active"
      :prepend-icon="child.action"
      no-action
      sub-group
    >
      <template v-slot:activator>
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-list-item v-bind="attrs" v-on="on">
              <v-list-item-avatar color="grey">
                <span>{{ index + 1 }}</span>
              </v-list-item-avatar>
              <v-list-item-title class="font-weight-medium">
                <v-badge
                  color="grey"
                  :content="
                    child.list_method.length > 0
                      ? child.list_method.length
                      : '0'
                  "
                >
                  {{ child.name }}
                </v-badge>
              </v-list-item-title>
              <v-list-item-action>
                <v-row>
                  <v-col>
                    <v-btn
                      icon
                      color="error"
                      @click="deleteScriptMethod(child.id, index)"
                    >
                      <v-icon color="#04153B80">mdi-delete</v-icon>
                    </v-btn>
                  </v-col>
                </v-row>
              </v-list-item-action>
            </v-list-item>
          </template>
          <span>{{ child.description }}</span>
        </v-tooltip>
      </template>

      <drag
        class="item-sub"
        :list="child.list_method"
        :script_method_id="child.id"
      />
    </v-list-group>
  </draggable>
</template>

    <script>
import draggable from "vuedraggable";
import { mapGetters, mapActions } from "vuex";
import apiScript from "../../services/axios/script";
export default {
  name: "drag",
  methods: {
    ...mapActions(["updateSubScriptMethod", "openSnack"]),
    log: function (evt) {
      if (evt.added) {
        if (this.list != null) {
          console.log(this.list);
          this.list = this.updateSubScript(this.list, this.script_method_id);
          this.updateSubScriptMethod({
            id: this.getSelectedScript.id,
            payload: this.list,
          });
        }
      }
    },
    deleteScriptMethod(id, i) {
      apiScript
        .deleteMethod(id)
        .then((res) => {
          this.realValue.splice(i, 1);
          this.openSnack({
            message: res.data.message,
            color: "success",
          });
        })
        .catch((err) => {
          this.openSnack({
            message: err.toString(),
            color: "error",
          });
        });
    },
    emitter(value) {
      if (value != null) {
        if (value.length > 0) {
          value.forEach((element, i) => {
            value[i].script_id = this.getSelectedScript.id;
            if (value[i].hasOwnProperty("script_method_id")) {
              delete value[i].script_method_id;
            }
            if (element.list_method.length > 0) {
              value[i].list_method = this.updateSubScript(
                element.list_method,
                element.id
              );
            }
          });
        }
        this.$emit("input", value);
        console.log(this.$store.getters.getListMethod);
      }
    },

    updateSubScript(value, script_method_id) {
      value.forEach((element, i) => {
        value[i].script_method_id = script_method_id;
        if (value[i].hasOwnProperty("script_id")) {
          delete value[i].script_id;
        }
        if (element.list_method.length > 0) {
          value[i].list_method = this.updateSubScript(
            value[i].list_method,
            element.id
          );
        }
      });
      return value;
    },
  },
  components: {
    draggable,
  },
  computed: {
    ...mapGetters(["getSelectedScript"]),
    dragOptions() {
      return {
        animation: 1,
        group: "description",
        disabled: false,
        ghostClass: "ghost",
      };
    },
    realValue() {
      return this.value ? this.value : this.list;
    },
  },
  props: {
    value: {
      required: false,
      type: Array,
      default: null,
    },
    list: {
      required: false,
      type: Array,
      default: null,
    },
    script_method_id: {
      required: false,
      type: Number,
      default: null,
    },
  },
};
</script>
