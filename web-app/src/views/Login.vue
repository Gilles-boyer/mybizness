<template>
  <v-container fluid style="background-color: #04153b" fill-height>
    <v-row justify="center" align-content="center">
      <v-col cols="11" sm="7" md="4" xl="3">
        <v-card class="pa-4 login" elevation="4" shaped>
          <v-card class="mx-auto pa-6" fluid shaped elevation="0">
            <v-img height="200px" src="../../public/logoMyBizness.png" />
            <v-form>
              <v-text-field
                label="Mail"
                class="primary--text"
                prepend-icon="mdi-account"
              ></v-text-field>
              <v-text-field
                type="password"
                label="Password"
                class="primary--text"
                prepend-icon="mdi-lock"
              ></v-text-field>
              <v-checkbox label="Restez connecté"></v-checkbox>
            </v-form>
            <v-card-actions class="pa-0 mt-4">
              <v-btn color="primary" class="px-5"> login </v-btn>
              <v-spacer></v-spacer>
              <v-btn text small> Reset password</v-btn>
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