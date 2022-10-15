<template>
  <v-container fluid style="background-color: #04153b" fill-height>
    <v-row justify="center" align-content="center">
      <v-col cols="11" sm="7" md="4" xl="3">
        <v-card class="pa-4 login" elevation="4" shaped>
          <v-card class="mx-auto pa-6" fluid shaped elevation="0">
            <v-img height="200px" src="/assets/logoMyBizness.png" />
            <v-form ref="form" v-model="valid" lazy-validation>
              <v-text-field
                v-model="password"
                :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                :rules="[rules.required, rules.min, rules.format]"
                :type="show ? 'text' : 'password'"
                name="input-10-1"
                label="Password"
                hint="+ 8 characters"
                counter
                @click:append="show = !show"
                prepend-icon="mdi-lock"
              ></v-text-field>
              <v-text-field
                v-model="confirmation_password"
                :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                :rules="[rules.required, rules.min, rules.confirmation]"
                :type="show ? 'text' : 'password'"
                name="input-10-1"
                label="Confirmation password"
                hint="confirmation password"
                counter
                @click:append="show = !show"
                prepend-icon="mdi-lock"
              ></v-text-field>
            </v-form>
            <v-card-actions class="pa-0 mt-4">
              <v-btn :disabled="!valid" color="primary" class="px-5 mx-auto" @click="validate">Confirmer</v-btn>
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

import apiApp from "../services/axios/application"

export default {
  methods: {
    validate () {
        if(this.$refs.form.validate()) {
            var reset = {
                token: this.$route.params.token,
                password: this.password
            }
            apiApp.updateUserPassword(reset).then(res => {
                alert("votre mot passe a bien été mis à jour, merci de vous connecter");
                this.$router.push('/login');
            }).catch(err => {
                console.log(err.toString());
                alert('erreur attribution mot de passe');
            })
        }
    },
    init() {
        apiApp.checkTokenExist({token: this.$route.params.token}).then(res => { }).catch(err => {
            console.log(err.toString())
            alert('erreur token');
            this.$router.push('/login');
        })
    }
  },

  mounted () {
    this.init();
  },
  data() {
    return {
      show: false,
      valid: true,
      password: "",
      confirmation_password:"",
      rules: {
        required: (value) => !!value || "Required.",
        min: (v) => v.length >= 8 || "Min 8 characters",
        confirmation: (v) => v == this.password || "confirmation différent",
        format: (v) => /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(v) || 'Vérifier le format du mot de passe',
      },
    };
  },
};
</script>
