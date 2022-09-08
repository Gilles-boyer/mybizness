<template>
  <v-list>
    <v-list-group v-for="item in items" :key="item.title" v-model="item.active" :prepend-icon="item.action"
      color="primary" no-action>
      <template v-slot:activator>
        <v-list-item-content>
          <v-list-item-title v-text="item.title"></v-list-item-title>
        </v-list-item-content>
      </template>

      <v-list-item v-for="data in item.items" :key="data.label" class="pa-0">
        <v-list-item-avatar>
          <img :src="data.img" />
        </v-list-item-avatar>
        <v-list-item-content>
          <v-card-text>
            <v-tooltip bottom>
              <template v-slot:activator="{ on, attrs }">
                <span v-bind="attrs" v-on="on">{{ data.label }} - {{ data.price }} €
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
export default {
  data() {
    const srcs = {
      1: "https://www.letelegramme.fr/images/2019/07/12/cette-piste-du-gp-circuit-je-pourrais-la-faire-les-yeux_4687124.jpg",
      2: "https://cdn.abcmoteur.fr/wp-content/uploads/2014/12/Renault-Megane-RS-Easydrift.jpg",
    };
    return {
      items: [
        {
          action: "mdi-go-kart",
          items: [
            {
              img: srcs[1],
              label: "karting de 10min pour une personne",
              price: 15,
            },
            {
              img: srcs[1],
              label: "karting de 2 x 10min pour une personne",
              price: 28,
            },
          ],
          title: "Karting",
        },
        {
          action: "mdi-car-select",
          items: [
            {
              img: srcs[2],
              label: "Baptême de easydrift",
              price: 39,
            },
            {
              img: srcs[2],
              label: "Inititiation Easydrift 20min",
              price: 89,
            },
          ],
          title: "Easydrift",
        },
      ],
    };
  },
  methods: {
    addProduct(product) {
      this.$emit("productToAdd", product);
    },
  },
};
</script>