<template>
	<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <router-link to="/" class="navbar-brand">Laravel</router-link>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <div v-if="!loggedIn">
	                    <!-- Right Side Of Navbar -->
	                    <ul class="navbar-nav ml-auto">
	                    	
	                            <li class="nav-item">
                                    <router-link :to="{name:'login'}" class="nav-link">Login</router-link>
	                            </li>
	                    </ul>
                    </div>
                    <div v-if="loggedIn">
                    	<ul class="navbar-nav ml-auto">
                    		<li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                    Admin <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <router-link :to="{name:'admin'}" class="nav-link">Admin-panel</router-link>
                                    <router-link :to="{name:'logout'}" class="nav-link">Logout</router-link>
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
  computed:{
    loggedIn()
    {
        return this.$store.getters.loggedIn
    }
  }
}
</script>
<style>
.dropdown-item{
    cursor:pointer;
}
</style>   