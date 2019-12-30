<template>
	<div>
		<navbar></navbar>
        <div class="py-4">
        	<spinner v-if="isLoading"></spinner>
        	<div v-else>
            	<router-view></router-view>        		
        	</div>		
        </div>
    </div>
</template>
<script>
import Navbar from "./components/navbar";
import Spinner from "vue-simple-spinner";
import {mapGetters} from 'vuex';
export default {
  name:"app",
  components:{
  	Navbar,
  	Spinner
  },
  computed: mapGetters(['isLoading']),
}
</script>