<template>
  <v-row justify="center" class="f100">
    <v-col cols="12" sm="12" md="8" xl="8">
      <ModelBonKdo />
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
          :items="getImagesOnline"
          item-text="name"
          :rules="[(v) => !!v.id || 'Merci de choisir une image']"
          label="Image du bon cadeau"
          required
          return-object
        ></v-select>

        <v-select
          v-model="font"
          :items="getFontsOnline"
          item-text="name"
          :rules="[(v) => !!v.id || 'Merci de choisir une police']"
          label="Style d'écriture du bon cadeau"
          required
          return-object
        ></v-select>

        <v-select
          v-model="color"
          :items="getColorsOnline"
          item-text="name"
          :rules="[(v) => !!v.id || 'Merci de choisir une couleur']"
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
      <v-img src="/assets/rotatePhone.gif"></v-img>
    </v-overlay>
  </v-row>
</template>
<script>
import ModelBonKdo from "./ModelBonKdo.vue";
import { mapGetters, mapActions } from "vuex";
export default {
  components: {
    ModelBonKdo,
  },
  data: () => ({
    absolute: true,
    opacity: 1,
    overlay: false,
    messageRules: [
      (v) => v.length <= 150 || "Merci de vérifier le nombre de caractère",
    ],
  }),
  computed: {
    ...mapGetters([
      "getImagesOnline",
      "getFontsOnline",
      "getColorsOnline",
      "getPersonalization",
      "getValidStep2",
    ]),
    dataMessage() {
      return (this.message = this.message.substring(0, 150));
    },
    valid: {
      get() {
        return this.getValidStep2;
      },
      set(value) {
        this.setValidStep2(value);
      },
    },
    message: {
      get() {
        if (this.getPersonalization.message) {
          return "Votre message";
        }
        return this.getPersonalization.message;
      },
      set(value) {
        this.setMessageStep2(value);
      },
    },
    image: {
      get() {
        if (!this.getPersonalization.image) {
          return {
            name: "eadydrift",
            src: "https://www.autonocion.com/wp-content/uploads/2014/05/easydrift-megane-rs-778x500.jpg",
            description: "easydrift",
          };
        }
        return this.getPersonalization.image;
      },
      set(value) {
        this.setImageStep2(value);
      },
    },
    font: {
      get() {
        if (!this.getPersonalization.font) {
          return { name: "roboto", font: "roboto" };
        }
        return this.getPersonalization.font;
      },
      set(value) {
        this.setFontStep2(value);
      },
    },
    color: {
      get() {
        if (!this.getPersonalization.color) {
          return { name: "Bleu", hex: "primary" };
        }
        return this.getPersonalization.color;
      },
      set(value) {
        this.setColorStep2(value);
      },
    },
  },
  methods: {
    ...mapActions([
      "initImagesOnline",
      "initFontsOnline",
      "initColorsOnline",
      "setResetStep2",
      "setValidStep2",
      "setMessageStep2",
      "setImageStep2",
      "setFontStep2",
      "setColorStep2",
    ]),
    validate() {
      if (this.$refs.form.validate()) {
        if (this.message == "Votre message") {
          this.message = "A trés vite au circuit !";
        }
        this.$emit("goToStep3");
      }
    },
    reset() {
      this.$refs.form.reset();
    },
    checkSizeWindowWidth() {
      if (window.innerWidth < 582) {
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
    this.initImagesOnline();
    this.initFontsOnline();
    this.initColorsOnline();
    this.setResetStep2(this.$refs.form);
  },
  created() {
    window.addEventListener("resize", this.myEventHandler);
  },
  destroyed() {
    window.removeEventListener("resize", this.myEventHandler);
  },
};
</script>
