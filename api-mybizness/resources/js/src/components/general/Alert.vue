<template >
    <v-alert
      dense
      outlined
      v-model="data.alert"
      dismissible
      :type="data.level"
      :value="data.alert"
    >
      {{ data.message }}
    </v-alert>
</template>

<script>
export default {
    props: {
        data: {
            type:Object,
            default:{
                level:"error",
                message:"",
                alert:true
            }
        }
    }
}
</script>
