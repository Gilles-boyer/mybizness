<template>
    <v-row justify="center">
        <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
            <v-card>
                <snackBar />
                <overlay />
                <v-toolbar dark color="primary">
                    <v-toolbar-title>Voucher N° {{ voucher.voucher.num }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn icon dark @click="close()">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </v-toolbar>
                <v-container>
                    <v-row align="center" justify="center">
                        <v-col cols="12" sm="12" md="2" xl="2" class="text-center">
                            <v-chip>
                                Status :
                                <v-icon class="ml-2" small :color="colorIconStatus(voucher.products)">
                                    mdi-circle
                                </v-icon>
                            </v-chip>
                        </v-col>
                        <v-col cols="6" sm="3" md="1" xl="1" align-self="center" class="mt-2"
                            v-if="!(colorIconStatus(voucher.products) == 'error')">
                            <v-row align="center" justify="center">
                                <v-btn icon @click="displayPdfVoucher(voucher.voucher.num)">
                                    <v-icon>mdi-printer</v-icon>
                                </v-btn>
                            </v-row>
                        </v-col>
                        <v-col cols="6" sm="3" md="1" xl="1" align-self="center" class="mt-2"
                            v-if="!(colorIconStatus(voucher.products) == 'error')">
                            <v-row align="center" justify="center">
                                <v-btn icon @click="downloadPdfvoucher(voucher.voucher.num)">
                                    <v-icon>mdi-download</v-icon>
                                </v-btn>
                            </v-row>
                        </v-col>

                        <!-- modal Add Day -->
                        <v-col cols="6" sm="3" md="1" xl="1" align-self="center" class="mt-2"
                            v-if="!(colorIconStatus(voucher.products) == 'error')">
                            <v-row justify="center">
                                <v-dialog v-model="dialogAddDay" persistent max-width="600px">
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-btn icon v-bind="attrs" v-on="on">
                                            <v-icon>mdi-calendar-plus</v-icon>
                                        </v-btn>
                                    </template>
                                    <v-card>
                                        <v-card-title>
                                            <span class="text-h5 primary--text">
                                                <v-icon class="mr-2">mdi-calendar-plus</v-icon> Ajouter
                                                des jours au bon cadeau
                                            </span>
                                        </v-card-title>
                                        <v-card-text>
                                            <v-form ref="formDay" v-model="validDay" lazy-validation>
                                                <v-container>
                                                    <v-row>
                                                        <v-col cols="12" sm="12" md="12">
                                                            <v-text-field v-model="nbJour" type="number"
                                                                label="Nombre de jour *"
                                                                :rules="[rules.minDay, rules.maxDay]" required>
                                                            </v-text-field>
                                                        </v-col>
                                                    </v-row>
                                                </v-container>
                                            </v-form>
                                            <small>*indicates required field</small>
                                        </v-card-text>
                                        <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn color="primary darken-1" text @click="resetNbDays()">
                                                Fermer
                                            </v-btn>
                                            <v-btn color="primary darken-1" text @click="validateAddDay()"
                                                :disabled="!validDay">
                                                Ajouter
                                            </v-btn>
                                        </v-card-actions>
                                    </v-card>
                                </v-dialog>
                            </v-row>
                        </v-col>

                        <!-- modal email -->
                        <v-col cols="6" sm="3" md="1" xl="1" align-self="center" class="mt-2"
                            v-if="!(colorIconStatus(voucher.products) == 'error')">
                            <v-row justify="center">
                                <v-dialog v-model="dialogSendMail" persistent max-width="600px">
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-btn icon v-bind="attrs" v-on="on">
                                            <v-icon>mdi-send</v-icon>
                                        </v-btn>
                                    </template>
                                    <v-card>
                                        <v-card-title>
                                            <span class="text-h5 primary--text">
                                                <v-icon class="mr-2">mdi-send</v-icon> Envoie par
                                                email
                                            </span>
                                        </v-card-title>
                                        <v-card-text>
                                            <v-form ref="formEmail" v-model="validMail" lazy-validation>
                                                <v-container>
                                                    <v-row>
                                                        <v-col cols="12" sm="12" md="12">
                                                            <v-text-field v-model="email" label="email *"
                                                                :rules="[rules.required, rules.email]" required>
                                                            </v-text-field>
                                                        </v-col>
                                                    </v-row>
                                                </v-container>
                                            </v-form>
                                            <small>*indicates required field</small>
                                        </v-card-text>
                                        <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn color="primary darken-1" text @click="resetEmail()">
                                                Fermer
                                            </v-btn>
                                            <v-btn color="primary darken-1" text @click="validateEmail()"
                                                :disabled="!validMail">
                                                Envoyer
                                            </v-btn>
                                        </v-card-actions>
                                    </v-card>
                                </v-dialog>
                            </v-row>
                        </v-col>
                        <!--  -->
                    </v-row>
                    <v-row align="center" justify="center">
                        <v-col cols="12" sm="6" md="3" xl="3">
                            <v-card rounded="30" class="login" min-height="320px">
                                <v-card-title>
                                    <v-icon class="mr-2">mdi-account</v-icon>
                                    Client
                                </v-card-title>
                                <v-card-text><strong>Client :</strong>
                                    {{ voucher.customer.name.toUpperCase() }}</v-card-text>
                                <v-card-text><strong>Téléphone :</strong>
                                    {{ voucher.customer.phone }}</v-card-text>
                                <v-card-text><strong>Email :</strong>
                                    {{ voucher.customer.email }}</v-card-text>
                            </v-card>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" xl="3">
                            <v-card rounded="30" class="login" min-height="320px">
                                <v-card-title>
                                    <v-icon class="mr-2">mdi-account</v-icon>
                                    Bénéficiaire
                                </v-card-title>
                                <v-card-text><strong>Client :</strong>
                                    {{ voucher.beneficiary.name.toUpperCase() }}</v-card-text>
                                <v-card-text><strong>Téléphone :</strong>
                                    {{ voucher.beneficiary.phone }}</v-card-text>
                                <v-card-text><strong>Email :</strong>
                                    {{ voucher.beneficiary.email }}</v-card-text>
                            </v-card>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" xl="3">
                            <v-card rounded="30" class="login" min-height="320px">
                                <v-card-title>
                                    <v-icon class="mr-2">mdi-format-list-bulleted</v-icon>
                                    Commande
                                </v-card-title>
                                <v-card-text><strong>Créé le :</strong>
                                    {{ formatDate(voucher.date_order) }}</v-card-text>
                                <v-card-text><strong>Créé par :</strong>
                                    {{ voucher.created_by.name }}</v-card-text>
                                <v-card-text >
                                    <v-chip :color="colorChipsValidity(voucher.voucher.validity)" class="white--text">
                                        <strong class="mr-1">Valide jusqu'au : </strong>
                                         {{
                                        formatDate(voucher.voucher.validity).substr(0, 17)
                                        }}
                                    </v-chip>
                                </v-card-text>
                                <v-card-text><strong>Payé par :</strong>
                                    {{ voucher.payment.name }}</v-card-text>

                            </v-card>
                        </v-col>
                        <v-col cols="12" sm="6" md="3" xl="3">
                            <v-card rounded="30" class="login" min-height="320px">
                                <v-card-title>
                                    <v-icon class="mr-2">mdi-folder-star</v-icon>
                                    Theme
                                </v-card-title>
                                <v-card-text><strong>Couleur du bon :</strong>
                                    <v-icon :color="voucher.voucher.color.hex">mdi-circle</v-icon>
                                </v-card-text>
                                <v-card-text><strong>Style d'écriture :</strong>
                                    {{ voucher.voucher.font.font }}</v-card-text>
                                <v-card-text><strong>Image :</strong>
                                    <v-avatar>
                                        <img :src="voucher.voucher.image.src" alt="John" />
                                    </v-avatar>
                                </v-card-text>
                                <v-card-text><strong>Message :</strong>
                                    {{ voucher.voucher.message }}</v-card-text>
                            </v-card>
                        </v-col>
                        <v-col cols="12" min-height="320">
                            <v-data-table style="min-height: 400px" :headers="headers" :items="voucher.products"
                                class="elevation-1 login">
                                <template v-slot:top>
                                    <v-toolbar flat color="#04153B10">
                                        <v-toolbar-title>
                                            <v-icon class="mr-2">mdi-gift</v-icon> Liste de cadeau
                                        </v-toolbar-title>
                                    </v-toolbar>
                                </template>
                                <template v-slot:item.used="{ item, index }">
                                    <v-switch inset @click="updateUsedProduct(item.ProductOrder_id, index)" v-if="!item.used"
                                        v-model="item.used" flat></v-switch>
                                    <v-chip v-if="item.used" small>
                                        Utilisé : {{ formatDate(item.used) }}
                                    </v-chip>
                                </template>
                                <template v-slot:item.img="{ item }">
                                    <v-avatar>
                                        <img :src="item.img" />
                                    </v-avatar>
                                </template>
                                <template v-slot:item.price="{ item }">
                                    {{ item.price }} €
                                </template>
                            </v-data-table>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card>
        </v-dialog>
    </v-row>
</template>
<script>
import apiVoucher from "../../services/axios/voucher";
import snackBar from "../general/SnackBar.vue";
import overlay from "../general/Overlay.vue";
import { mapActions } from "vuex";
export default {
    components: {
        snackBar,
        overlay,
    },
    methods: {
        validateEmail() {
            if (this.$refs.formEmail.validate()) {
                this.openOverlay();
                apiVoucher
                    .sendVoucherByMail(this.voucher.voucher.num, this.email)
                    .then((res) => {
                        this.closeOverlay();
                        this.openSnack({
                            message: "mail envoyé",
                            color: "success",
                        });
                    })
                    .catch((err) => console.log(err.toString()));
                this.resetEmail();
            }
        },
        validateAddDay() {
            if (this.$refs.formDay.validate()) {
                apiVoucher
                    .addDayToValidityVoucher(this.voucher.voucher.id, this.nbJour)
                    .then((res) => {
                        this.voucher.voucher.validity = this.addDaysToDate(
                            this.voucher.voucher.validity,
                            this.nbJour
                        );
                        this.openSnack({
                            message: "Date modifiée",
                            color: "success",
                        });
                        this.dialogAddDay = false;
                    })
                    .catch((err) => console.log(err.toString()));
                this.nbJour;
            }
        },

        addDaysToDate(date, days) {
            var res = new Date(date);
            res.setDate(res.getDate() + parseInt(days));
            return res;
        },
        resetEmail() {
            this.dialogSendMail = false;
            this.$refs.formEmail.reset();
        },
        resetNbDays() {
            this.dialogAddDay = false;
            this.$refs.formDay.reset();
        },
        ...mapActions(["openSnack", "openOverlay", "closeOverlay"]),
        close() {
            this.$emit("closeModalVoucher");
        },
        async displayPdfVoucher(data) {
            window.open(`/api/voucher/display/pdf/${data}`, "_blank");
        },
        async downloadPdfvoucher(data) {
            window.open(`/api/voucher/download/pdf/${data}`, "_blank");
        },
        colorChipsValidity(date) {
            var days = this.differenceTodayDays(date);
            if (days < 0) {
                return "error";
            } else if (days < 10) {
                return "orange";
            } else {
                return "#2e4200";
            }
        },
        differenceTodayDays(date1) {
            var date1 = new Date(date1);
            var date2 = new Date();
            var difference = date1.getTime() - date2.getTime();
            return parseInt(difference / (1000 * 3600 * 24));
        },
        formatDate(date) {
            let d = new Date(date);
            let options = {
                weekday: "short",
                year: "numeric",
                month: "short",
                day: "numeric",
                hour: "numeric",
                minute: "numeric",
                hour12: false,
            };
            return new Intl.DateTimeFormat("fr-FR", options).format(d);
        },
        updateUsedProduct(productOrderId, index) {
            apiVoucher
                .updateStatusUsed(productOrderId)
                .then((res) => {
                    this.openSnack({
                        message: "utilisation du voucher mis à jour",
                        color: "success",
                    });
                    var d = new Date();
                    this.voucher.products[index].used = d.toString();
                })
                .catch((err) => console.log(err.toString()));
        },
        colorIconStatus(products) {
            var nbProduct = products.length;
            var nbUsed = 0;
            products.forEach((product) => {
                if (product.used) {
                    nbUsed++;
                }
            });
            if (nbUsed == 0) {
                return "#2e4200";
            } else if (nbUsed == nbProduct) {
                return "error";
            } else {
                return "orange";
            }
        },
    },
    props: {
        dialog: {
            type: Boolean,
            default: false,
        },
        voucher: {
            type: Object,
            default: {},
        },
    },
    data() {
        return {
            email: "",
            validMail: true,
            validDay: true,
            nbJour: 0,
            dialogSendMail: false,
            dialogAddDay: false,
            headers: [
                {
                    text: "image",
                    align: "start",
                    sortable: false,
                    value: "img",
                },
                { text: "Cadeau", value: "name" },
                { text: "Prix", value: "price" },
                { text: "Action", value: "used" },
            ],
            rules: {
                required: (value) => !!value || "Required.",
                maxDay: (value) => value <= 90 || "max 90 jours",
                minDay: (value) => value >= 1 || "min 1 jour",
                email: (value) => {
                    const pattern =
                        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return pattern.test(value) || "Invalid e-mail.";
                },
            },
        };
    },
};
</script>
