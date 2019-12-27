<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sezon {{sezon.name}}</div>

                <div class="card-body">
                    <img :src="sezon.logo_path" width="150px">
                    <p>{{sezon.start}} -- {{sezon.finish}}</p>
                    <p>{{sezon.desc}}</p>
                    <hr>
                    <h3>Epizods</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md" v-for="epizod in epizods">
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
import axios from 'axios';
export default {
  props:['id'],
  data() {
    return {
      loading: false,
      sezon: {},
      epizods: null,
      error: null,
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      this.error = this.epizods = null;
      this.loading = true;
      axios
        .get('/api/sezon/'+this.id+'/epizods')
        .then(response => {
          this.loading = false;
          this.sezon = response.data.sezon;
          this.epizods = response.data.epizods;
        });
    }
  }
}
</script>