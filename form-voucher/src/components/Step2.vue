<template>
  <v-row justify="center" align="center" class="f100">
    <v-col cols="12" sm="12" md="8" xl="8">
      <ModelBonKdo
        :themeGift="image"
        :fontGift="font.name"
        :messageGift="dataMessage"
        :background="color.hex"
      />
    </v-col>
    <v-col cols="12" sm="12" md="4" xl="4">
      <v-form ref="form" align="center" v-model="valid" lazy-validation>
        <v-textarea
          :rules="messageRules"
          :counter="150"
          v-model="message"
          label="Votre message"
        ></v-textarea>

        <v-select
          v-model="image"
          :items="images"
          item-text="name"
          :rules="[(v) => !!v.id || 'Item is required']"
          label="Theme du bon cadeau"
          required
          return-object
        ></v-select>

        <v-select
          v-model="font"
          :items="fonts"
          item-text="name"
          item-value="font"
          :rules="[(v) => !!v.id || 'Item is required']"
          label="Style d'écriture du bon cadeau"
          return-object
          required
        ></v-select>

        <v-select
          v-model="color"
          :items="colors"
          item-text="name"
          :rules="[(v) => !!v.id || 'Item is required']"
          label="Couleur du Bon Cadeau"
          required
          return-object
        ></v-select>

        <v-btn
          width="100%"
          :disabled="!valid"
          color="primary"
          @click="validate"
        >
          Valider
        </v-btn>
      </v-form>
    </v-col>
    <v-overlay
      color="primary"
      :absolute="absolute"
      :opacity="opacity"
      :value="overlay"
    >
      <v-img :src="url + '/public/image/rotatePhone.gif'"></v-img>
    </v-overlay>
  </v-row>
</template>
<script>
import ModelBonKdo from "./ModelBonKdo";
import urlBase from "../data/urlBase.json";
import apiImage from "../service/Image";
import apiFont from "../service/font";
import apiColors from "../service/color";
export default {
  components: {
    ModelBonKdo,
  },
  data: () => ({
    url: urlBase.base,
    absolute: true,
    color: {},
    colors: [],
    images: [],
    fonts: [],
    font: {},
    image: {},
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
      return (this.message = this.message.substring(0, 150));
    },
  },
  methods: {
    chargePolice(item) {
      document.head.insertAdjacentHTML(
        "beforeend",
        `<style>@import url('${item.font}');</style>`
      );
    },
    async initColor() {
      var res = await apiColors.getColors();
      this.colors = res.data.data;
    },
    async initImage() {
      var res = await apiImage.getImages();
      this.images = res.data.data;
    },
    async initFont() {
      var res = await apiFont.getFonts();
      this.fonts = res.data.data;
      res.data.data.forEach((font) => this.chargePolice(font));
    },
    validate() {
      if (this.$refs.form.validate()) {
        if (this.message == "Votre message") {
          this.message = "A trés vite au circuit !";
        }
        var personalization = {
          color: this.color.id,
          image: this.image.id,
          font: this.font.id,
          message: this.message,
        };

        this.$emit("dataPersonalization", personalization);
      }
    },    
    checkSizeWindowWidth() {
      if (window.innerWidth < 550) {
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
    this.initImage();
    this.initFont();
    this.initColor();
  },
  created() {
    window.addEventListener("resize", this.myEventHandler);
  },
  destroyed() {
    window.removeEventListener("resize", this.myEventHandler);
  },
};
</script>