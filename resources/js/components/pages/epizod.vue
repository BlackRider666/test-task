<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Epizod: {{epizod.name}}</div>

                <div class="card-body">
                    <h1>{{epizod.name}}</h1>
                    <img :src="epizod.logo_path" width="150px">
                    <p>{{epizod.release}}</p>
                    <p>{{epizod.desc}}</p>
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
      epizod: {},
      error: null,
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      this.error = null;
      this.loading = true;
      axios
        .get('/api/epizod/'+this.id)
        .then(response => {
          this.loading = false;
          this.epizod = response.data;
        });
    }
  }
}
</script>