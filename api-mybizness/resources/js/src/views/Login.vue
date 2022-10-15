<template>
  <v-container fluid style="background-color: #04153b" fill-height>
    <v-row justify="center" align-content="center">
      <v-col cols="11" sm="7" md="4" xl="3">
        <v-card class="pa-4 login" elevation="4" shaped>
          <v-card class="mx-auto pa-6" fluid shaped elevation="0">
            <v-img height="200px" src="/assets/logoMyBizness.png" />
            <v-form ref="form" v-model="valid" lazy-validation>
              <v-text-field
                label="Mail"
                v-model="loginData.email"
                class="primary--text"
                :rules="[rules.required, rules.email]"
                prepend-icon="mdi-account"
              ></v-text-field>
              <v-text-field
                v-model="loginData.password"
                :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                :rules="[rules.required, rules.min, rules.format]"
                :type="show ? 'text' : 'password'"
                name="input-10-1"
                label="Password"
                counter
                @click:append="show = !show"
                prepend-icon="mdi-lock"
              ></v-text-field>
              <v-checkbox label="Restez connecté"></v-checkbox>
            </v-form>
            <v-card-actions class="pa-0 mt-4 ">
              <v-btn color="primary" class="px-5 mx-auto" @click="validate" :disabled="!valid"> login </v-btn>
            </v-card-actions>
          </v-card>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<style >
.login {
  background: rgb(9, 66, 121);
  background: linear-gradient(
    180deg,
    rgba(9, 66, 121, 1) 0%,
    rgba(255, 255, 255, 1) 100%
  );
}
</style>

<script>

import { mapActions } from "vuex";

export default {
  data() {
    return {
      valid: true,
      show: false,
      loginData: {
        email:"",
        password:""
      },
      rules: {
        required: (value) => !!value || "Required.",
        min: (v) => v.length >= 8 || "Min 8 characters",
        format: (v) => /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(v) || 'Vérifier le format du mot de passe',
        email: (v) => {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return pattern.test(v) || 'Invalid e-mail.'
        },
      },
    }
  },

  methods: {
    ...mapActions(['login']),
    validate () {
      if(this.$refs.form.validate())
      {
         this.login(this.loginData);
      }
    },
  }
}
</script>
