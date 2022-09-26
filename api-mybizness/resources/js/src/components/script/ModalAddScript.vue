<template>
  <v-row justify="center">
    <v-dialog v-model="getScriptDialog.dialog" persistent max-width="600px">
      <v-card>
        <v-card-title>
          <span class="text-h5">{{ getScriptDialog.title }}</span>
        </v-card-title>

        <v-card-text>
          <v-container>
            <v-form ref="form" v-model="valid" lazy-validation>
              <v-row>
                <v-col cols="12">
                  <v-text-field
                    :rules="[(v) => !!v || 'Name is required']"
                    v-model="getScriptDialog.name"
                    label="Name*"
                    required
                  >
                  </v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-textarea
                    :rules="[(v) => !!v || 'Name is required']"
                    v-model="getScriptDialog.description"
                    name="Description*"
                    label="Description"
                  ></v-textarea>
                </v-col>
              </v-row>
            </v-form>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="close()"> Close </v-btn>
          <v-btn
            @click="validate"
            :disabled="!valid"
            color="blue darken-1"
            text
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  methods: {
    ...mapActions(["openScriptDialog", "pushScripts", "openSnack"]),
    validate() {
      if (this.$refs.form.validate()) {
        this.pushScripts(this.getScriptDialog).then((res) => {
          var opensnack = {
            message: res.message,
          };
          console.log(res);

          if (res.success) {
            opensnack.color = "success";
          } else {
            opensnack.color = "error";
          }
          this.openSnack(opensnack);
          this.close();
        });
      }
    },
    close() {
      this.$refs.form.reset();
      this.getScriptDialog.dialog = false;
    },
  },
  data: () => ({
    valid: true,
    title: "",
  }),
  computed: {
    ...mapGetters(["getScriptDialog"]),
  },
};
</script>
