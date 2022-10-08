<template>
  <v-card class="pa-1 login full100" shaped>
    <slot></slot>
  </v-card>
</template>
<style >
.login {
  background: rgb(9, 66, 121);
  background: linear-gradient(
    180deg,
    rgb(59, 103, 145) 0%,
    rgba(255, 255, 255, 1) 100%
  );
}
.full100 {
  height: 100%;
  width: 100%;
}
</style>
