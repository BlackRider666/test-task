export default {
	actions:{},
	mutations:{
		changeLoading(state){
			state.loading = !state.loading;
		}
	},
	state:{
		loading:false,
	},
	getters:{
		isLoading(state){
			return state.loading;
		}
	}
}