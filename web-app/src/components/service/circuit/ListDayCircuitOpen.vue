 <template>
  <v-card flat shaped class="full100 pa-2">
    <v-row class="fill-height" justify="center">
      <v-col cols="12">
        <v-row justify="center">
          <v-date-picker
            v-model="date"
            class="mx-auto mt-4"
            @change="init()"
            :min="today"
            locale="fr-fr"
          ></v-date-picker>
        </v-row>
      </v-col>
      <v-col
        cols="12"
        sm="6"
        md="3"
        xl="2"
        v-for="(day, index) in listDay"
        :key="index"
        class="text-center"
      >
        <v-card shaped v-if="!day.open">
          <v-card-title style="background-color: #04153b" class="white--text">
            <v-row justify="center">
              <v-col cols="12" class="pa-0">
                {{ weekday[day.date.getDay()] }}
              </v-col>
              <v-col cols="12" class="pa-0">
                {{ day.date.toLocaleDateString() }}
              </v-col>
            </v-row>
          </v-card-title>
          <v-card-actions>
            <v-btn outlined color="success" width="100%" rounded>Ouvrir</v-btn>
          </v-card-actions>
        </v-card>

        <v-card shaped v-if="day.open">
          <v-card-title style="background-color: #04153b" class="white--text">
            <v-row justify="center">
              <v-col cols="12" class="pa-0">
                {{ weekday[day.date.getDay()] }}
              </v-col>
              <v-col cols="12" class="pa-0">
                {{ day.date.toLocaleDateString() }}
              </v-col>
            </v-row>
          </v-card-title>
          <v-card-actions>
            <v-icon>mdi-cog</v-icon>
            <v-icon>mdi-eye</v-icon>
            <v-spacer></v-spacer>
            <v-switch label="online">online</v-switch>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-card>
</template> 

<script>
import ServiceDate from "../../../service/function/date";
import reservationApi from "../../../data/ouverture.json";
export default {
  methods: {
    init() {
      var listDate = this.DefineListDayByMonth();

      listDate.forEach((item) => {
        reservationApi.forEach((resa) => {
          var date = new Date(resa.date).toLocaleDateString();
          if (date == item.date.toLocaleDateString()) {
            item.open = true;
            item.reservation = resa;
          }
        });
      });

      this.listDay = listDate;

      //generer des objets date restant dans le mois avec par default open = close
      //requeter l'api pour récupérer la liste des journées déclaré ouvert en fonction de la date
      // comparer la liste objet date et la liste des journée ouvert
      // Pour ceux qui ont la meme date open = true et ajouté les infos de la journée ouvert
      // retournée la liste

      //fonction init
      // Definir la liste avec la fonction de generer les objets date
    },
    DefineListDayByMonth() {
      var listDay = [];
      var date = new Date(this.date);
      var lastDayMonth = ServiceDate.lastDay(
        date.getFullYear(),
        date.getMonth()
      );
      var dateToday = date.getDate();
      var maxI = lastDayMonth - dateToday;

      for (var i = 0; i <= maxI; i++) {
        var day = ServiceDate.addDays(date, i);
        listDay.push({
          date: day,
          open: false,
        });
      }
      return listDay;
    },
  },
  data() {
    return {
      date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      today: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      listDay: [],
      menu2: false,
      weekday: [
        "Dimanche",
        "Lundi",
        "Mardi",
        "Mercredi",
        "Jeudi",
        "Vendredi",
        "Samedi",
      ],
    };
  },
  created() {
    this.init();
  },
};
</script>