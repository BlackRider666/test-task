<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Serials</div>

                <div class="card-body">
                    <div class="row">
                    	<div v-for="serial in allSerials">
                        <router-link :to="{ name: 'serial_show', params: { id: serial.id }}" class="nav-link">
                            <div class="col-md">
                                <img :src="serial.logo_path" width="150px">
                                <p>{{ serial.name}}</p>
                            </div>
                        </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import {mapGetters} from 'vuex';
export default {
  computed: mapGetters(['allSerials']),
  mounted(){
    this.$store.commit('changeLoading');
    this.$store.dispatch('fetchSerials');
    this.$store.commit('changeLoading');
  }
}
</script>