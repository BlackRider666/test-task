<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sezon {{getSezon.name}}</div>

                <div class="card-body">
                    <img :src="getSezon.logo_path" width="150px">
                    <p>{{getSezon.start}} -- {{getSezon.finish}}</p>
                    <p>{{getSezon.desc}}</p>
                    <hr>
                    <h3>Epizods</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md" v-for="epizod in getEpizods">
                            <router-link :to="{ name: 'epizod_show', params: { id: epizod.id }}" class="nav-link"><img :src="epizod.logo_path" width="150px"><p>{{epizod.name}}</p></router-link>
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
  computed: mapGetters(['getSezon','getEpizods']),
  mounted(){
    this.$store.commit('changeLoading');
    this.$store.dispatch('getSezon',this.id);
    this.$store.commit('changeLoading');
  }
}
</script>