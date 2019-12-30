<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Epizod: {{getEpizod.name}}</div>

                <div class="card-body">
                    <h1>{{getEpizod.name}}</h1>
                    <img :src="getEpizod.logo_path" width="150px">
                    <p>{{getEpizod.release}}</p>
                    <p>{{getEpizod.desc}}</p>
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
  computed: mapGetters(['getEpizod']),
  mounted(){
    this.$store.commit('changeLoading');
    this.$store.dispatch('getEpizod',this.id);
    this.$store.commit('changeLoading');
  },
  methods: {
  }
}
</script>