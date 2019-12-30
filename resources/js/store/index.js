import Vue from 'vue';
import Vuex from 'vuex';
import serials from './modules/serials.js'
import sezons from './modules/sezons.js'
import epizods from './modules/epizods.js'
import auth from './modules/auth.js'
import app from './modules/app.js'
Vue.use(Vuex);

export default new Vuex.Store({
	modules:{
		app,serials,auth,sezons,epizods
	}
});