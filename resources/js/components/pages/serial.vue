<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{serial.name}}</div>

                <div class="card-body">
                    <h1>{{serial.name}}</h1>
                    <img :src="serial.logo_path" width="150px">
                    <p>{{serial.start}}</p>
                    <p>{{serial.desc}}</p>
                    <hr>
                    <h3>Seasons</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md" v-for="sezon in sezons">
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
import axios from 'axios';
export default {
  props:['id'],
  data() {
    return {
      loading: false,
      sezons: null,
      serial:{},
      error: null,
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      this.error = this.sezons = null;
      this.loading = true;
      axios
        .get('/api/serial/'+this.id)
        .then(response => {
          this.loading = false;
          this.serial = response.data.serial;
          this.sezons = response.data.sezons;
        });
    }
  }
}
</script>