<template>
  <v-row justify="center" align="center" class="f100">
    <v-col cols="12" sm="12" md="8" xl="8">
      <ModelBonKdo :themeGift="theme" :fontGift="fontFamily" :messageGift="dataMessage" :background="colorGift.code" />
    </v-col>
    <v-col cols="12" sm="12" md="4" xl="4">
      <v-form ref="form" align="center" v-model="valid" lazy-validation>
        <v-textarea :rules="messageRules" :counter="150" v-model="message" label="Votre message"></v-textarea>

        <v-select v-model="theme" :items="listTheme" item-text="name" :rules="[(v) => !!v || 'Item is required']"
          label="Theme du bon cadeau" required return-object></v-select>

        <v-select v-model="fontFamily" :items="listFontFamily" item-text="name" item-value="code"
          :rules="[(v) => !!v || 'Item is required']" label="Style d'écriture du bon cadeau" required></v-select>


        <v-select v-model="colorGift" :items="listColor" item-text="name" :rules="[(v) => !!v || 'Item is required']"
          label="Couleur du Bon Cadeau" required return-object></v-select>



        <v-btn width="100%" :disabled="!valid" color="primary" @click="validate">
          Valider
        </v-btn>
      </v-form>
    </v-col>
    <v-overlay color="primary" :absolute="absolute" :opacity="opacity" :value="overlay">
      <v-img :src="url + '/public/image/rotatePhone.gif'"></v-img>
    </v-overlay>
  </v-row>
</template>
<script>
import ModelBonKdo from "./ModelBonKdo";
import dataFontFamily from "../data/listFontFamily.json";
import dataColor from "../data/listColor.json";
import urlBase from "../data/urlBase.json"
export default {
  components: {
    ModelBonKdo,
  },
  data: () => ({
    url: urlBase.base,
    absolute: true,
    colorGift: { name: "Bleu", code: "primary" },
    listColor: dataColor,
    listTheme: [
      { name: "Standard", img: "https://lh3.googleusercontent.com/Kw1ECouosamsscGTfG-BjnXJTg1wklDYUaDozZ5x_DQb4NTQ2xntYd6ERgA5pHEsEwRzNVBv8X8eeIx6=s0" },
      { name: "Easydrift", img: "https://easydriftdts.com/wp-content/uploads/2019/04/cfg_boutique.jpg" }
    ],
    listFontFamily: dataFontFamily,
    fontFamily: "Roboto",
    theme: { name: "Standard", img: "https://lh3.googleusercontent.com/Kw1ECouosamsscGTfG-BjnXJTg1wklDYUaDozZ5x_DQb4NTQ2xntYd6ERgA5pHEsEwRzNVBv8X8eeIx6=s0" },
    opacity: 1,
    overlay: false,
    valid: true,
    message: "Votre message",
    messageRules: [
      (v) => v.length <= 150 || "Merci de vérifier le nombre de caractère",
    ],
  }),
  computed: {
    dataMessage() {
      return this.message = this.message.substring(0, 150);
    }
  },
  methods: {
    validate() {
      if (this.$refs.form.validate()) {
        if (this.message == "Votre message") {
          this.message = "A trés vite au circuit !"
        }
        var personalization = {
          theme: this.theme,
          backgroundColor: this.colorGift.code,
          fontFamily: this.fontFamily,
          message: this.message,
        };

        this.$emit('dataPersonalization', personalization);
      }
    },
    reset() {
      this.$refs.form.reset();
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },
    checkSizeWindowWidth() {
      if (window.innerWidth < 667) {
        return (this.overlay = true);
      }
      return (this.overlay = false);
    },
    myEventHandler(e) {
      this.checkSizeWindowWidth();
    },
  },
  mounted() {
    this.checkSizeWindowWidth();
  },
  created() {
    window.addEventListener("resize", this.myEventHandler);
  },
  destroyed() {
    window.removeEventListener("resize", this.myEventHandler);
  },
};
</script>