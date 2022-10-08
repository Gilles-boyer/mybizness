<template>
  <v-list>
    <v-list-group
      v-for="cat in getCatOnline"
      :key="cat.id"
      v-model="cat.active"
      :prepend-icon="cat.icon"
      color="primary"
      no-action
    >
      <template v-slot:activator>
        <v-list-item-content>
          <v-list-item-title v-text="cat.name"></v-list-item-title>
        </v-list-item-content>
      </template>

      <v-list-item v-for="data in cat.products" :key="data.id" class="pa-0">
        <v-list-item-avatar>
          <img :src="data.img" />
        </v-list-item-avatar>
        <v-list-item-content>
          <v-card-text>
            <v-tooltip bottom>
              <template v-slot:activator="{ on, attrs }">
                <span v-bind="attrs" v-on="on"
                  >{{ data.name }} - {{ data.price }} €
                </span>
              </template>
              <span>
                {{ data.description }}
              </span>
            </v-tooltip>
          </v-card-text>
        </v-list-item-content>
        <v-btn @click="addProduct(data)" text color="primary">Ajouter</v-btn>
      </v-list-item>
    </v-list-group>
  </v-list>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {};
  },

  mounted() {
    this.initCatOnline();
  },
  methods: {
    ...mapActions(["initCatOnline"]),
    addProduct(product) {
      this.$emit("productToAdd", product);
    },
  },
  computed: {
    ...mapGetters(["getCatOnline"]),
  },
};
</script>
