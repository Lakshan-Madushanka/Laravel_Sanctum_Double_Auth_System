<template>
  <div id="signin">
    <div class="signin-form">
      <form @submit.prevent="onSubmit">
        <div class="input" :class="{ invalid: v$.email.$error }">
          <label for="email">Mail</label>
          <input
            type="email"
            id="email"
            @blur="v$.email.$touch()"
            v-model="email"
          />
          <p class="error" v-if="v$.email.required.$invalid && v$.email.$error">
            This field must not be empty.
          </p>
          <p class="error" v-if="v$.email.email.$invalid && v$.email.$error">
            Please provide a valid email address.
          </p>
        </div>
        <div class="input" :class="{ invalid: v$.password.$error }">
          <label for="password"> Password</label>
          <input
            type="password"
            id="password"
            @blur="v$.password.$touch()"
            v-model="password"
          />
          <p
            class="error"
            v-if="v$.password.pattern.$invalid && v$.password.$error"
          >
            Password should be 8 characters with including lowe and upper class
            characters symbol and number
          </p>
        </div>
        <p class="error-danger" v-if="errors.length > 0">
          {{ errors[0] }}
        </p>
        <div class="submit">
          <button type="submit" :hidden="isloading" :disabled="v$.$invalid">
            Submit
          </button>
        </div>
        <div class="spinner-border text-primary" role="status" v-if="isloading">
          <span class="sr-only">Loading...</span>
        </div>
        <!-- <button type="submit" :disabled="v$.$invalid">Submit</button> -->
      </form>
    </div>
  </div>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import {
  required,
  email,
  numeric,
  minValue,
  minLength,
  sameAs,
  requiredUnless,
} from "@vuelidate/validators";

import { login } from "../../store/types";

export default {
  setup() {
    return { v$: useVuelidate() };
  },
  data() {
    return {
      email: "",
      password: "",
    };
  },
  validations() {
    return {
      email: {
        required,
        email,
      },
      password: {
        required,
        minLen: minLength(6),
        pattern: (value) => {
          var re = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
          return re.test(value);
        },
      },
    };
  },
  methods: {
    onSubmit() {
      const formData = {
        email: this.email,
        password: this.password,
      };
      this.$store.dispatch(login, formData);
      console.log(formData);
    },
  },
  computed: {
    errors() {
      return this.$store.getters.authErrorData.login;
    },
    isloading() {
      return this.$store.state.loading;
    },
  },
  mounted() {
    let isAuthenticatd = this.$store.getters.authData.isAuthenticated;
    console.log(isAuthenticatd);
    console.log("lakakzzzzzz");
    if (isAuthenticatd) {
      console.log(isAuthenticatd);
      console.log("pissu");

      this.$router.push("/");
    }
  },
};
</script>

<style scoped>
.signin-form {
  width: 400px;
  margin: 30px auto;
  border: 1px solid #eee;
  padding: 20px;
  box-shadow: 0 2px 3px #ccc;
}

.input {
  margin: 10px auto;
}

.input label {
  display: block;
  color: #4e4e4e;
  margin-bottom: 6px;
}

.input input {
  font: inherit;
  width: 100%;
  padding: 6px 12px;
  box-sizing: border-box;
  border: 1px solid #ccc;
}

.input input:focus {
  outline: none;
  border: 1px solid #521751;
  background-color: #eee;
}

.submit button {
  border: 1px solid #521751;
  color: #521751;
  padding: 10px 20px;
  font: inherit;
  cursor: pointer;
}

.submit button:hover,
.submit button:active {
  background-color: #521751;
  color: white;
}

.submit button[disabled],
.submit button[disabled]:hover,
.submit button[disabled]:active {
  border: 1px solid #ccc;
  background-color: transparent;
  color: #ccc;
  cursor: not-allowed;
}
.input.invalid label {
  color: red;
}

.input.invalid input {
  border: 1px solid red;
  background-color: #ffc9aa;
}
.error {
  color: rgb(33, 143, 247);
}

.error-danger {
  color: red;
}
</style>
