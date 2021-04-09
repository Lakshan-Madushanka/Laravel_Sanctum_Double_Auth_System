import { createStore, createLogger } from 'vuex'
import auth from './modules/auth'
import alert from './modules/alert'

export default createStore({
  state: {
    loading: false,

  },
  mutations: {
    startLoading: (state) => {
      state.loading = true;
    },
    setAuthenticated: (state, user) => {
      state.user = user;
    },
    stopLoading: (state) => {
      state.loading = false;
    },
  },
  actions: {
  },
  modules: {
    auth,
    alert
  },
  plugins: [createLogger()],

})
