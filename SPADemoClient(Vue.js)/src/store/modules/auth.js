import api from '../../utills/axios';
import * as types from '../types.js';
import router from '../../router/index'
import {
	sanctum_csrf_cookie,
	sanctum_login,
	sanctum_logout
} from '../../utills/routesList'

const state = {
	auth: {
		isAuthenticated: false,
		user: null,
	},
	errors: {login:[]}
};

const mutations = {
	setErrors: (state, errors) => {
		state.errors.login.push(errors);	
	},
  setAuthData: (state, user) => {
		state.auth.user = user
		state.auth.isAuthenticated = true
		router.push('/');

	},
	clearLoginErrors: (state) => {
		state.errors.login = []
	},
	clearAuthData: (state) => {
		state.auth.user = null;
		state.auth.isAuthenticated = false
	}
};


const actions = {
  [types.login]: async ({ commit, dispatch }, user) => {
		try {
			commit('startLoading');

			const csrf = await api.get('sanctum/csrf-cookie')
			const login = await api.post('login', user);

			dispatch(types.LOAD_AUTH_USER)

			commit('stopLoading');
			commit('clearLoginErrors')

		} catch (error) {
			commit('stopLoading');
			commit('clearLoginErrors')
		
			const errors = error.data && error.data.errors
			if (errors['email'][0] === "These credentials do not match our records.") {
				 commit('setErrors', errors['email'][0] )
			 }
			for (let error in errors) {
				dispatch(types.LOAD_ALERT, { [error]: errors[error], type:"danger" })
			}
		 }
  },
  
  [types.registerOrAddUser]: async ({ commit, dispatch}, user) => {
		try {
			commit('startLoading');
			const res = await api.post('users/register', user)
			router.push({name: 'signin'})
			commit('stopLoading');
		} catch (err) {
			commit('stopLoading');
			const errors = err.response.data && err.response.data.errors
			for (let error in errors) {
				dispatch(types.LOAD_ALERT, { [error]: errors[error], type:"danger" })
			}
		}
	},

	[types.LOAD_AUTH_USER]: async ({ commit }) => {
		try {
			const user = await api.get('user');
			commit('setAuthData', user)
		} catch (error) {
			//console.warn(error)
		}
	},
	
	[types.logout]: async ({ commit }, payload) => {
		await api.post('logout');
		commit('clearAuthData');
	},

};

const getters = {
	authData: (state) => {
		return state.auth
	},
	authErrorData: (state) => {
		return state.errors
	},
	
};

export default {
	state,
	getters,
	mutations,
	actions,
};
