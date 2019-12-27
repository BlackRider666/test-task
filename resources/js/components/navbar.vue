<template>
	<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <router-link to="/" class="navbar-brand">Laravel</router-link>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <div v-if="!app.user">
	                    <!-- Right Side Of Navbar -->
	                    <ul class="navbar-nav ml-auto">
	                    	
	                            <li class="nav-item">
                                    <router-link to="/login" class="nav-link">Login</router-link>
	                            </li>
	                    </ul>
                    </div>
                    <div v-else>
                    	<ul class="navbar-nav ml-auto">
                    		<li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                    {{app.user.name}} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" @click="logout()">
                                        Logout
                                    </a>
                                </div>
                            </li>
                    	</ul>
                    </div>
                </div>
            </div>
        </nav>
</template>
<script>
import axios from 'axios';
export default {
  name:'navbar',
  props:['app'],
  data() {
    return {
    };
  },
  methods:{
    logout(){
        const data = {
            token:localStorage.token,
          }
        axios.post('/api/auth/logout/',data)
        .then(response => {
          this.app.user = null;
        });
    }
  }
}
</script>