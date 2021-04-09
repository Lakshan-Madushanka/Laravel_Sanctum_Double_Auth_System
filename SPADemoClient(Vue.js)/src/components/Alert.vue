<template>
  <div v-if="Object.keys(alerts).length > 0">
    <div v-for="alert in alerts" :key="alert.alertID">
      <div
        :class="'alert alert-' + alert.msg.type"
        role="alert"
        v-for="msg in Object.values(alert.msg)[0]"
        :key="msg"
      >
        {{ msg }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["alerts"],

  computed: {},
};
</script>

<style scoped>
.alert {
  width: 50%;
  margin: 10px auto 0;
}
</style>