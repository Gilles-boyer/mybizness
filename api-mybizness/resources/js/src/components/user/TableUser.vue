<template>
  <v-data-table
    :headers="headers"
    :items="Users"
    :search="search"
    class="elevation-1 font-weight-medium login"
  >
    <template v-slot:top>
      <v-toolbar flat color="#04153B10" class="mb-12">
        <v-toolbar-title>Liste des utilisateurs</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
              Ajouter un utilisateur
            </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="text-h5">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="12" md="12" v-if="!(editedIndex > -1)">
                    <v-text-field

                      v-model="editedItem.first_name"
                      label="Prénom"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="12" md="12" v-if="!(editedIndex > -1)">
                    <v-text-field
                      v-model="editedItem.last_name"
                      label="Nom"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="12" md="12" v-if="!(editedIndex > -1)">
                    <v-text-field
                      v-model="editedItem.email"
                      label="Email"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="12" md="12" v-if="!(editedIndex > -1)">
                    <v-text-field
                      v-model="editedItem.phone"
                      label="Téléphone"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="12" md="12">
                    <v-select
                      :items="roles"
                      item-text="role_name"
                      v-model="editedItem.role"
                      label="Role"
                      return-object
                    ></v-select>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close"> Cancel </v-btn>
              <v-btn color="blue darken-1" text @click="save"> Save </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5"
              >Are you sure you want to delete this item?</v-card-title
            >
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete"
                >Cancel</v-btn
              >
              <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                >OK</v-btn
              >
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
      <v-row class="px-4">
        <v-col>
          <v-switch
            v-model="switchAdminStaff"
            inset
            label="Voir que Staff et Admin"
          ></v-switch>
        </v-col>
        <v-col>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
          ></v-text-field>
        </v-col>
      </v-row>
    </template>

    <!-- action -->
    <template v-slot:item.actions="{ item }">
      <v-icon small class="mr-2" @click="sendResetPassword(item)"> mdi-lock-reset</v-icon>
      <v-icon small class="mr-2" @click="editItem(item)"> mdi-pencil </v-icon>
      <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
    </template>
    <!--  -->

    <!-- utilisateur -->
    <template v-slot:item.first_name="{ item }">
      {{ item.first_name + " " + item.last_name }}
    </template>
    <!--  -->

    <!-- online -->
    <template v-slot:item.online="{ item }">
      <v-switch
        v-model="item.online"
        @change="updateOnline(item.id)"
        inset
      ></v-switch>
    </template>

    <!-- role -->
    <template v-slot:item.role="{ item }">
      <v-chip :color="colorChipsForRoleUser(item.role.role_name)">
        {{ item.role.role_name }}
      </v-chip>
    </template>

    <template v-slot:no-data>
      <v-btn color="primary" @click="initialize"> Reset </v-btn>
    </template>
  </v-data-table>
</template>

<script>
import apiUser from "../../services/axios/user";
import apiRole from "../../services/axios/role";
import { mapActions } from "vuex";

export default {
  data: () => ({
    dialog: false,
    switchAdminStaff: false,
    dialogDelete: false,
    search: "",
    headers: [
      {
        text: "Utilisateur",
        align: "start",
        sortable: false,
        value: "first_name",
      },
      { text: "Téléphone", value: "phone" },
      { text: "Email", value: "email" },
      { text: "Role", value: "role" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    users: [],
    roles: [],
    editedIndex: -1,
    editedItem: {
      id: 0,
      first_name: "",
      last_name: "",
      phone: "",
      email: "",
      role: {},
    },
    defaultItem: {
      id: 0,
      first_name: "",
      last_name: "",
      phone: "",
      email: "",
      role: {},
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1
        ? "Ajouter utilisateur"
        : "Modifier utilisateur";
    },

    Users() {
      if (this.switchAdminStaff) {
        return this.users.filter(
          (user) =>
            user.role.role_name == "admin" || user.role.role_name == "staff"
        );
      }
      return this.users;
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    ...mapActions(["openSnack"]),

    sendResetPassword(user)
    {
      apiUser.sendLinkResetPassword({email:user.email}).then(res => {
        this.openSnack({
          message: "lien pour le mot de passe envoyé",
          color: "success",
        });
      }).catch(err => {
        console.log(err.toString);
        this.openSnack({
          message: "erreur d'envoi du mail pour le mot de passe",
          color: "error",
        });
      })
    },

    initialize() {
      apiUser.getAllUsers().then((res) => {
        this.users = res.data.data;
      });
      apiRole.getAllRole().then((res) => {
        this.roles = res.data.data;
      });
    },

    colorChipsForRoleUser(roleName) {
      if (roleName === "admin") {
        return "primary";
      } else if (roleName === "staff") {
        return "#7397d9";
      } else {
        return "";
      }
    },

    editItem(item) {
      this.editedIndex = this.users.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.users.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      apiUser.deleteUser(this.users[this.editedIndex].id).then((res) => {
        this.users.splice(this.editedIndex, 1);
        this.openSnack({
          message: "utilisateur supprimé",
          color: "success",
        });
        this.closeDelete();
      });
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        apiUser
           .updateUser(this.users[this.editedIndex].id, {
            role_id: this.editedItem.role.id,
          })
          .then((res) => {
            Object.assign(this.users[this.editedIndex], this.editedItem);
            this.openSnack({
              message: "utilisateur modifiée",
              color: "success",
            });
            this.close();
          })
          .catch((err) => console.log(err.toString()));
      } else {
        apiUser.storeNewUser({
            first_name: this.editedItem.name,
            last_name: this.editedItem.name,
            email: this.editedItem.email,
            phone: this.editedItem.phone,
            role_id: this.editedItem.role.id,
          })
          .then((res) => {
            this.users.push(res.data.data);
            this.openSnack({
              message: "utilisateur créé",
              color: "success",
            });
            this.close();
          })
          .catch((err) => console.log(err.toString()));
      }
    },
  },
};
</script>
