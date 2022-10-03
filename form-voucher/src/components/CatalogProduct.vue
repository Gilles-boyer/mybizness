<template>
  <v-list>
    <v-list-group v-for="cat in categories" :key="cat.id" v-model="cat.active" :prepend-icon="cat.icon"
      color="primary" no-action>
      <template v-slot:activator>
        <v-list-item-content>
          <v-list-item-title v-text="cat.name"></v-list-item-title>
        </v-list-item-content>
      </template>

      <v-list-item v-for="product in cat.products" :key="product.id" class="pa-0">
        <v-list-item-avatar>
          <img :src="product.img" />
        </v-list-item-avatar>
        <v-list-item-content>
          <v-card-text>
            <v-tooltip bottom>
              <template v-slot:activator="{ on, attrs }">
                <span v-bind="attrs" v-on="on">{{ product.name }} - {{ product.price }} €
                </span>
              </template>
              <span>
                Le karting est un sport mécanique qui vous assure des
                sensations. Pratiqué sur un circuit extérieur ou intérieur, il
                exige beaucoup de concentration et une bonne dose de témérité.
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
  import apiProduct from "../service/product"
export default {
  data() {  
    return {
      categories:[]
    };
  },
  mounted() {
    this.initProducts();
  },
  methods: {
    async initProducts() {
      var res = await apiProduct.getProductByCat()
      this.categories = res.data.data;
      console.log(res);
    },
    addProduct(product) {
      this.$emit("productToAdd", product);
    },
  },
};
</script>