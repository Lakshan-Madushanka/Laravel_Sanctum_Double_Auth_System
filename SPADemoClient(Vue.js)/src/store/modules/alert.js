import {SET_ALERT, REMOVE_ALERT, LOAD_ALERT, ALERT_DATA}  from '../types.js';
import { v4 as uuidv4 } from 'uuid';

const state = {
	data: []
};

const mutations = {

	[SET_ALERT]: (state, payload) => {
		state.data.push(payload);
	},

	[REMOVE_ALERT]: (state, alertID) => {
		console.log(Date.now())
		const data = state.data.filter(data => data.alertID !== alertID);
		state.data = data
		console.log(state.data)
	},

};

const actions = {

	[LOAD_ALERT]: ({ commit }, msg) => {
		const alertID = uuidv4();
		const payload = { msg, alertID }
		
		commit(SET_ALERT, payload);
  	setTimeout(() => commit(REMOVE_ALERT, alertID), 5000);
	}

};

const getters = {
	[ALERT_DATA]: (state) => {
		return state.data
	},

};



export default {
	state,
	getters,
	mutations,
	actions,
};
