import axios from 'axios';
export default {
	actions:{
		getEpizod(context,id){
			axios.get('/api/epizod/'+id)
	        .then(response => {
	          context.commit('updateEpizod',response.data)
	        });	
		},
		addEpizod(context,data){
			axios.post('/api/epizod/store',
		          data,
		          {
		          headers: {
		              'Content-Type': 'multipart/form-data'
		          }
		        }
		      ).then(response => {
		        context.commit('addEpizod',response.data)
		      });
		}
	},
	mutations:{
		updateEpizods(state,epizods){
			state.epizods = epizods;
		},
		updateEpizod(state,epizod){
			state.epizod = epizod;
		},
		addEpizod(state,epizod){
			state.epizods.push(epizod);
		}

	},
	state:{
		epizods:[],
		epizod:{},
	},
	getters:{
		getEpizods(state)
		{
			return state.epizods;
		},
		getEpizod(state)
		{
			return state.epizod;
		}
	}
}