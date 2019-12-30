import axios from 'axios';
export default {
	actions:{
		getToken(context,credentials){
			return new Promise((resolve,reject) =>{
				axios.post('/api/auth/login',{
					email: credentials.email,
					password: credentials.password,
				})
		        .then(response => {
		        	const token = response.data.access_token;
		        	localStorage.setItem('access_token',token);
		        	context.commit('setToken',token);
		        	resolve(response)
		        })
		        .catch(error => {
		        	reject(error)
		        })
	        })
		},
		getUser(context){
			axios.defaults.headers.common['Authorization'] = 'Bearer '+ context.state.token
			if(context.getters.loggedIn){
				return new Promise((resolve,reject) =>{
					axios.get('/api/user',)
			        .then(response => {
			        	context.commit('setUser',response.data);
			        	resolve(response)
			        })
			        .catch(error => {
			        	reject(error)
			        })
		        })	
			}
		},
		destroyToken(context){
			axios.defaults.headers.common['Authorization'] = 'Bearer '+ context.state.token
			if(context.getters.loggedIn){
				return new Promise((resolve,reject) =>{
					axios.post('/api/auth/logout',)
			        .then(response => {
			        	localStorage.removeItem('access_token');
			        	context.commit('destroyToken');
			        	resolve(response)
			        })
			        .catch(error => {
			        	localStorage.removeItem('access_token');
			        	context.commit('destroyToken');
			        	reject(error)
			        })
		        })	
			}
		}
	},
	mutations:{
		setToken(state,token){
			state.token = token;
		},
		destroyToken(state){
			state.token = null;
		},
		setUser(state,user){
			state.user = user
		}
	},
	state:{
		token: localStorage.getItem('access_token') || null,
		user: null,
	},
	getters:{
		loggedIn(state)
		{
			return state.token !== null
		},
		userIsAdmin(state)
		{
			return user.admin
		}
	}
}