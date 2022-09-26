<template>
  <div class="text-center">
    <v-dialog v-model="acl.dialog" width="500">
      <v-card>
        <v-card-title class="text-h5 grey lighten-2 mb-5">
          Gestion des droits
        </v-card-title>

        <v-card-subtitle> Droits pour les roles </v-card-subtitle>

        <v-card-text>
          <v-row justify="center" align="center">
            <v-col v-for="role in acl.roles" :key="role.id">
              <v-switch
                v-model="role.activate"
                @change="updatePermissionRole(role.id)"
                color="success"
                :label="role.role_name"
                dense
                hide-details
              ></v-switch>
            </v-col>
          </v-row>
        </v-card-text>

        <v-card-subtitle class="mt-3 mb-0">
          Droits pour les Applications
        </v-card-subtitle>

        <v-card-text>
          <v-row justify="center" align="center">
            <v-col v-for="app in acl.applications" :key="app.id">
              <v-switch
                v-model="app.activate"
                @change="updatePermissionApp(app.id)"
                color="success"
                :label="app.app_name"
                dense
                hide-details
              ></v-switch>
            </v-col>
          </v-row>
        </v-card-text>

        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="acl.dialog = false">
            Close
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import apiRole from "../../services/axios/role";
import apiApp from "../../services/axios/application";
export default {
  methods: {
    ...mapActions(["openSnack"]),
    updatePermissionRole(roleId) {
      apiRole
        .updateRoleACL(roleId, this.acl.method_id)
        .then((res) => {
          this.openSnack({
            message: res.data.message,
            color: "success",
          });
        })
        .catch((error) => {
          this.openSnack({
            message: error.toString(),
            color: "error",
          });
        });
    },
    updatePermissionApp(appId) {
      apiApp
        .updateAppACL(appId, this.acl.method_id)
        .then((res) => {
          this.openSnack({
            message: res.data.message,
            color: "success",
          });
        })
        .catch((error) => {
          this.openSnack({
            message: error.toString(),
            color: "error",
          });
        });
    },
  },
  props: {
    acl: {
      type: Object,
      default: {
        dialog: false,
        method_id: 0,
        roles: [],
        applications: [],
      },
    },
  },
};
</script>
