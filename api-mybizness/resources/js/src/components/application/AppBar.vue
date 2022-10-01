<template>
    <v-app-bar dense app v-if="buttons[0]">
      <v-tabs centered elevation="2" color="primary">
        <v-tab
          v-for="button in buttons"
          :key="button.icon"
          :title="button.label"
          v-model="tabs"
          @click="changeTab(button.href)"
        >
          <v-icon color="primary">{{ button.icon }}</v-icon>
        </v-tab>
      </v-tabs>
    </v-app-bar>
  </template>
  <script>export default {
    data: () => ({
    }),
    props: {
        buttons:{
            type:Array,
            required:true,
        },
        tabs:{
            type:String,
            required:true,
        }
    },
    methods:{
        changeTab(tab) {
            this.$emit('valueTab', tab);
        }
    }

}
  </script>
