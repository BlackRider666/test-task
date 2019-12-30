import axios from 'axios';
export default {
	actions:{
		getSezon(context,id){
			axios.get('/api/sezon/'+id+'/epizods')
	        .then(response => {
	        	context.commit('updateSezon', response.data.sezon)
	        	context.commit('updateEpizods', response.data.epizods)
	        });
		},
		addSezon(context,data){
			axios.post('/api/sezon/store',
		          data,
		          {
		          headers: {
		              'Content-Type': 'multipart/form-data'
		          }
		        }
		      ).then(response => {
	        	  context.commit('addSezon', response.data)
		        
		      });
		}
	},
	mutations:{
		updateSezons(state,sezons){
			state.sezons = sezons;
		},
		updateSezon(state,sezon){
			state.sezon = sezon;
		},
		addSezon(state,sezon){
			state.sezons.push(sezon);
		}

	},
	state:{
		sezons:[],
		sezon:{},
	},
	getters:{
		getSezons(state)
		{
			return state.sezons;
		},
		getSezon(state)
		{
			return state.sezon;
		}
	}
}