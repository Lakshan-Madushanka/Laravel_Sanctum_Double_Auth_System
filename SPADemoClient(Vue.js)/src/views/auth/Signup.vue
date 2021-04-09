<template>
  <div id="signup">
    <div class="signup-form">
      <form @submit.prevent="onSubmit">
        <div
          class="input"
          :class="{ invalid: v$.email.$error || verifyEmailUnique }"
        >
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
          <p v-for="error in verifyEmailUnique" :key="error" class="error">
            {{ error }}
          </p>
        </div>

        <div class="input" :class="{ invalid: v$.name.$error }">
          <label for="name">Name</label>
          <input
            type="text"
            id="name"
            @blur="v$.name.$touch()"
            v-model="name"
          />
          <p class="error" v-if="v$.name.minLen.$invalid && v$.name.$error">
            Name should contain at least {{ v$.name.minLen.$params.min }}.
          </p>
          <p class="error" v-if="v$.name.required.$invalid && v$.name.$error">
            This field must not be empty.
          </p>
        </div>

        <div class="input" :class="{ invalid: v$.password.$error }">
          <label for="password"> Password</label>
          <input
            type="password"
            id="password"
            @blur="v$.password.$touch()"
            @change="v$.confirmPassword.$touch()"
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

        <div
          class="input"
          :class="{
            invalid: v$.confirmPassword.$error || password !== confirmPassword,
          }"
        >
          <label for="confirm-password">Confirm Password</label>
          <input
            type="password"
            id="confirm-password"
            @change="v$.confirmPassword.$touch()"
            v-model="confirmPassword"
          />
          <p
            class="error"
            v-if="
              (v$.confirmPassword.sameAsPassword.$invalid &&
                v$.confirmPassword.$error) ||
              password !== confirmPassword
            "
          >
            Passwords do not match
          </p>
        </div>
        <div class="input inline" :class="{ invalid: v$.terms.$invalid }">
          <input
            type="checkbox"
            id="terms"
            @change="v$.terms.$touch()"
            v-model="terms"
          />
          <label for="terms">Accept Terms of Use</label>
        </div>
        <div class="submit">
          <button
            type="submit"
            :hidden="isloading"
            :disabled="v$.$invalid || password !== confirmPassword"
          >
            Submit
          </button>
        </div>
        <div class="spinner-border text-primary" role="status" v-if="isloading">
          <span class="sr-only">Loading...</span>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import { registerOrAddUser, ALERT_DATA } from "../../store/types";
import {
  required,
  email,
  numeric,
  minValue,
  minLength,
  sameAs,
  requiredUnless,
} from "@vuelidate/validators";
export default {
  setup() {
    return { v$: useVuelidate() };
  },
  data() {
    return {
      email: "",
      name: "",
      password: "",
      confirmPassword: "",
      terms: "",
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
      confirmPassword: {
        // sameAsPassword: sameAs("password"),
        //    sameAsPassword: sameAs((vm) => {
        //           return vm.password;
        // },
        sameAsPassword: (value) => {
          return value === this.password;
        },
      },
      name: {
        required,
        minLen: minLength(5),
      },
      terms: {
        checked(value) {
          return value;
        },
      },
    };
  },
  methods: {
    onSubmit() {
      const formData = {
        email: this.email,
        name: this.name,
        password: this.password,
        password_confirmation: this.confirmPassword,
      };

      this.$store.dispatch(registerOrAddUser, formData);
    },
  },
  computed: {
    verifyEmailUnique() {
      const errorAlerts = this.$store.getters[ALERT_DATA];
      for (let error of errorAlerts) {
        if (error) {
          if (error.msg.email) {
            return error.msg.email;
          }
        }
      }
    },
    isloading() {
      return this.$store.state.loading;
    },
  },
};
</script>

<style scoped>
.signup-form {
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

.input.inline label {
  display: inline;
}

.input input {
  font: inherit;
  width: 100%;
  padding: 6px 12px;
  box-sizing: border-box;
  border: 1px solid #ccc;
}

.input.inline input {
  width: auto;
}

.input input:focus {
  outline: none;
  border: 1px solid #521751;
  background-color: #eee;
}

.input.invalid label {
  color: red;
}

.input.invalid input {
  border: 1px solid red;
  background-color: #ffc9aa;
}

.input select {
  border: 1px solid #ccc;
  font: inherit;
}

.hobbies button {
  border: 1px solid #521751;
  background: #521751;
  color: white;
  padding: 6px;
  font: inherit;
  cursor: pointer;
}

.hobbies button:hover,
.hobbies button:active {
  background-color: #8d4288;
}

.hobbies input {
  width: 90%;
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

.error {
  color: rgb(33, 143, 247);
}
</style>