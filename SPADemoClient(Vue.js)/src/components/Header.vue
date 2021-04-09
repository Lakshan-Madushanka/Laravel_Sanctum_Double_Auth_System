<template>
  <header id="header">
    <div class="logo">
      <router-link to="/">Sanctum Authentication System</router-link>
    </div>
    <nav>
      <ul>
        <p @click="test">{{ auth }}</p>

        <li v-if="!isAuthenticated">
          <router-link :to="{ name: 'signup' }">Sign Up</router-link>
        </li>
        <li v-if="!isAuthenticated">
          <router-link :to="{ name: 'signin' }">Sign In</router-link>
        </li>
        <li isAuthenticated>
          <router-link :to="{ name: 'adminDashboard' }">Dashboard</router-link>
        </li>
        <li v-if="isAuthenticated">
          <button @click="onLogout" class="logout">Logout</button>
          <p class="user" v-if="isAuthenticated">{{ user.name }}</p>
        </li>
      </ul>
    </nav>
  </header>
</template>

<script>
import { logout } from "../store/types";
export default {
  data() {
    return {
      user: {},
      isAuthenticated: false,
    };
  },
  computed: {
    auth() {
      this.isAuthenticated = this.$store.getters.authData.isAuthenticated;
      this.user = this.$store.getters.authData.user;
    },
  },
  methods: {
    onLogout() {
      this.$store.dispatch(logout);
    },
    test() {
      console.log(this.$store.getters.authData);
    },
  },
};
</script>

<style scoped>
#header {
  height: 56px;
  display: flex;
  flex-flow: row;
  justify-content: space-between;
  align-items: center;
  background-color: #9b0d98;
  padding: 0 20px;
}

.logo {
  font-weight: bold;
  color: white;
}

.logo:hover a {
  color: #fa923f;
}

.logo a {
  text-decoration: none;
  color: white;
}

nav {
  height: 100%;
}

ul {
  list-style: none;
  margin: 0;
  padding: 0;
  height: 100%;
  display: flex;
  flex-flow: row;
  align-items: center;
}

li {
  margin: 0 16px;
}

li a {
  text-decoration: none;
  color: white;
}

li a:hover,
li a:active,
li a.router-link-active {
  color: #fa923f;
}

.logout {
  background-color: transparent;
  border: none;
  font: inherit;
  color: white;
  cursor: pointer;
}
.user {
  color: rgb(255, 94, 0);
  font-size: 12px;
}
</style>