<template>
  <v-container fluid class="pa-0" fill-height>
    <Tab :buttons="Buttons" :tabs="Tabs" @valueTab="setTabs($event)" />
    <v-tabs-items v-model="Tabs" style="background-color: grey" class="full100">
      <v-tab-item value="Gift" class="pa-2 full100">
        <v-card class="pa-1 login full100" shaped>
          <v-card flat shaped class="full100 pa-2">
            <ListGift />
          </v-card>
        </v-card>
      </v-tab-item>
      <v-tab-item value="Client">
        <v-card class="pa-2 login">
          <v-card flat>
            <v-card-text> Gilles boyer 2</v-card-text>
          </v-card>
        </v-card>
      </v-tab-item>
    </v-tabs-items>
  </v-container>
</template>
<style>
.full100 {
  height: 100%;
  width: 100%;
}
</style>
<script src="./js/gift">
</script>