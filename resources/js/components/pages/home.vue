<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Serials</div>

                <div class="card-body">
                    <div class="row">
                    	<div v-for="serial in serials">
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
import axios from 'axios';
export default {
  data() {
    return {
      loading: false,
      serials: null,
      error: null,
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      this.error = this.serials = null;
      this.loading = true;
      axios
        .get('/api/serials')
        .then(response => {
          this.loading = false;
          this.serials = response.data;
        });
    }
  }
}
</script>