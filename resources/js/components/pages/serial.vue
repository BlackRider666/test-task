<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{getSerial.name}}</div>

                <div class="card-body">
                    <h1>{{getSerial.name}}</h1>
                    <img :src="getSerial.logo_path" width="150px">
                    <p>{{getSerial.start}}</p>
                    <p>{{getSerial.desc}}</p>
                    <hr>
                    <h3>Seasons</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md" v-for="sezon in getSezons">
                            <router-link :to="{ name: 'sezon_show', params: { id: sezon.id }}" class="nav-link">
                              <img :src="sezon.logo_path" width="150px">
                            </router-link>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
</template>	
<script>
import {mapGetters} from 'vuex';
export default {
  props:['id'],
  computed: mapGetters(['getSerial','getSezons']),
  mounted(){
    this.$store.commit('changeLoading');
    this.$store.dispatch('getSerial',this.id);
    this.$store.commit('changeLoading');
  }
}
</script>