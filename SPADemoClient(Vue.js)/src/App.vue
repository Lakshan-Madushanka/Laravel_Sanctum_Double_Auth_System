<template>
  <app-header></app-header>
  <transition
    enter-active-class="animate__animated animate__wobble animate__slow"
    leave-active-class="animate__animated animate__jello animate__slow"
  >
    <app-alert
      :alerts="getAlertData"
      v-if="Object.keys(getAlertData).length > 0"
    ></app-alert>
  </transition>

  <!-- <div id="nav">
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link>
  </div>
  <router-view /> -->
  <router-view />
</template>


<script>
import Dashboard from "./views/admin/Dashboard";
import Header from "./components/Header";
import Alert from "./components/Alert.vue";
import { LOAD_AUTH_USER } from "../src/store/types";
import api from "./utills/axios";
export default {
  data() {
    return {
      show: false,
    };
  },
  methods: {},
  components: {
    //appAdminDashboard: Dashboard,
    appHeader: Header,
    appAlert: Alert,
  },

  computed: {
    getAlertData() {
      // return 5;
      return this.$store.state.alert.data;
    },
  },

  async created() {
    console.log("hello");
    const user = await api.get("user");
    this.$store.commit("setAuthData", user);
  },
};
</script>
<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
