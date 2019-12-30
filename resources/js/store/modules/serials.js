import axios from 'axios';
export default {
	actions:{
		fetchSerials(context){
			axios.get('/api/serials')
	        .then(response => {
	        	context.commit('updateSerials', response.data)
	        });
		},
		getSerial(context,id){
			axios.get('/api/serial/'+id)
	        .then(response => {
	        	context.commit('updateSerial', response.data.serial)
	        	context.commit('updateSezons', response.data.sezons)
	        });
		},
		addSerial(context,data){
			axios.post('/api/serial/store',
		          data,
		          {
		          headers: {
		              'Content-Type': 'multipart/form-data'
		          }
		        }
		      ).then(response => {
		        context.commit('addSerial',response.data);
		      });
		}
	},
	mutations:{
		updateSerials(state,serials){
			state.serials = serials;
		},
		updateSerial(state,serial){
			state.serial = serial;
		},
		addSerial(state,serial){
			state.serials.push(serial);
		}
	},
	state:{
		serials:[],
		serial: {},
	},
	getters:{
		allSerials(state){
			return state.serials;
		},
		getSerial(state){
			return state.serial;
		}
	}
}