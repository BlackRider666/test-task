<template>
	<div>
		<navbar :app="this"></navbar>
        <div class="py-4">
        	<spinner v-if="loading"></spinner>
        	<div v-else-if="initiated">
            	<router-view></router-view>        		
        	</div>		
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import Navbar from "./components/navbar";
import Spinner from "vue-simple-spinner";
export default {
  name:"app",
  components:{
  	Navbar,
  	Spinner
  },
  data() {
    return {
    	user: null,
    	loading: false,
    	initiated:false,
    };
  },
  mounted(){
    this.init();
  	
  },
  methods:{
  	init(){
  		this.loading = true;
      var token = localStorage.token;
  		axios
        .get('/api/user/',{
          headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer '+token
          }
        })
        .then(response => {
          this.user = response.data;
          this.loading = false;
          this.initiated = true;
        }).catch( error => {
          this.loading = false;
          this.initiated = true;
        });
  	}
  }
}
</script>