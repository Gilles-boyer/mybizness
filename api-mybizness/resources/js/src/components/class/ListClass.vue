<template>
  <v-list>
    <dialogRole :acl="aclData" />

    <v-list-group
      class="mt-5"
      v-for="item in items"
      :key="item.id"
      v-model="item.active"
      prepend-icon="mdi-folder-text"
      no-action
    >
      <template v-slot:activator>
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-list-item-content v-bind="attrs" v-on="on">
              <v-list-item-title
                class="font-weight-bold primary--text"
                v-text="item.name"
              ></v-list-item-title>
            </v-list-item-content>
          </template>
          <span>{{ item.description }}</span>
        </v-tooltip>
      </template>

      <draggable
        class="dragArea list-group elevation-1"
        :list="item.list_method"
        :group="{ name: 'function', pull: 'clone', put: false }"
        :clone="cloneElement"
        @change="log"
      >
        <v-list-item
          class="list-group-item"
          v-for="child in item.list_method"
          :key="child.id"
        >
          <v-tooltip bottom>
            <template v-slot:activator="{ on, attrs }">
              <v-row>
                <v-col>
                  <v-list-item-content v-bind="attrs" v-on="on">
                    <v-list-item-title v-text="child.name"></v-list-item-title>
                  </v-list-item-content>
                </v-col>
              </v-row>
            </template>
            <span>{{ child.description }}</span>
          </v-tooltip>
          <v-list-item-action>
            <v-row>
              <v-col>
                <v-btn
                  @click="
                    openDialogRole(child.roles, child.applications, child.id)
                  "
                  text
                >
                  ACL
                </v-btn>
              </v-col>
            </v-row>
          </v-list-item-action>
        </v-list-item>
      </draggable>
    </v-list-group>
  </v-list>
</template>

<script>
import dialogRole from "../role/DialogRole.vue";
import draggable from "vuedraggable";
import { mapGetters } from "vuex";
export default {
  components: {
    dialogRole,
    draggable,
  },
  computed: {
    ...mapGetters(["getSelectedScript"]),
  },
  methods: {
    openDialogRole(roles, apps, method_id) {
      this.aclData.roles = roles;
      this.aclData.applications = apps;
      this.aclData.dialog = true;
      this.aclData.method_id = method_id;
    },
    log: function (evt) {
      window.console.log(evt);
    },
    cloneElement: function (data) {
      return {
        method_id: data.id,
        name: data.name,
        description: data.description,
        list_method: [],
        script_id: this.getSelectedScript.id,
      };
    },
  },
  props: ["items"],
  name: "ListClass",
  data: () => ({
    aclData: {
      dialog: false,
      roles: [],
      applications: [],
      method_id: 0,
    },
  }),
};
</script>
