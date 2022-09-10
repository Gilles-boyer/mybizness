<template>
  <v-container
    fill-height
    align-center
    justify-center
    style="background-color: #04153b; border-radius: 20px"
    elevation-10
  >
    <v-row class="white--text text-center f100 ma-1" justify="space-between">
      <v-col cols="12" sm="6" md="3" xl="2">
        <v-row justify="space-between" class="f100">
          <v-col cols="12">
            <v-avatar color="error" size="40">
              <span class="white--text text-h5">1</span>
            </v-avatar>
          </v-col>
          <v-col cols="12"> Je choisis mes cadeaux </v-col>
          <v-col cols="12">
            <v-img
              max-height="200"
              max-width="200"
              :src="$store.state.base+'/public/image/cadeau.png'"
              class="mx-auto pa-16"
            ></v-img>
          </v-col>
        </v-row>
      </v-col>
      <v-col cols="12" sm="6" md="3" xl="2">
        <v-row class="f100">
          <v-col cols="12">
            <v-avatar color="error" size="40">
              <span class="white--text text-h5">2</span>
            </v-avatar>
          </v-col>
          <v-col cols="12"> Je personnalise mon Bon </v-col>
          <v-col cols="12">
            <v-img
              max-height="200"
              max-width="200"
              :src="$store.state.base+'/public/image/custum.png'"
              class="mx-auto pa-16"
            ></v-img>
          </v-col>
        </v-row>
      </v-col>
      <v-col cols="12" sm="6" md="3" xl="2">
        <v-row class="f100">
          <v-col cols="12">
            <v-avatar color="error" size="40">
              <span class="white--text text-h5">3</span>
            </v-avatar>
          </v-col>
          <v-col cols="12"> Je complete le formulaire d'achat </v-col>
          <v-col cols="12">
            <v-img
              max-height="200"
              max-width="200"
              :src="$store.state.base+'/public/image/form.png'"
              class="mx-auto pa-16"
            ></v-img>
          </v-col>
        </v-row>
      </v-col>
      <v-col cols="12" sm="6" md="3" xl="2">
        <v-row class="f100">
          <v-col cols="12">
            <v-avatar color="error" size="40">
              <span class="white--text text-h5">4</span>
            </v-avatar>
          </v-col>
          <v-col cols="12"> Je paye mon Bon Cadeau</v-col>
          <v-col cols="12">
            <v-img
              max-height="200"
              max-width="200"
              :src="$store.state.base+'/public/image/cb.png'"
              class="mx-auto pa-16"
            ></v-img>
          </v-col>
        </v-row>
      </v-col>
      <v-col cols="12" sm="6" md="3" xl="2">
        <v-row class="f100">
          <v-col cols="12">
            <v-avatar color="error" size="40">
              <span class="white--text text-h5">5</span>
            </v-avatar>
          </v-col>
          <v-col cols="12"> Je reçois ma facture et mon bon </v-col>
          <v-col cols="12">
            <v-img
              max-height="200"
              max-width="200"
              :src="$store.state.base+'/public/image/invoice.png'"
              class="mx-auto pa-16"
            ></v-img>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: "HelloWorld",

  data: () => ({
  }),
};
</script>

<style>
.f100 {
  height: 100%;
}
</style>
