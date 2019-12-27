<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Sezon to {{serial.name}}</div>

                <div class="card-body">
                  <form v-on:submit.prevent="submitAddSezon">
                        <div class="form-group">
                            <label for="serialLogo">Logo</label>
                            <input type="file" class="form-control" id="serialLogo" v-on:change="handleFileUpload" ref="file">
                        </div>
                        <div class="form-group">
                            <label for="serialDesc">Desc</label>
                            <textarea v-model="desc" class="form-control" id="serialDesc" placeholder="Enter serial desc">                             
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="serialStart">Start Date</label>
                            <input type="date" class="form-control" id="serialStart" v-model="start">
                        </div>
                        <div class="form-group">
                            <label for="serialFinish">Finish Date</label>
                            <input type="date" class="form-control" id="serialFinish" v-model="finish">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <div class="row">
                        <div class="col-md" v-for="sezon in sezons">
                            <router-link :to="{ name: 'admin_epizods', params: { id: sezon.id }}" class="nav-link"><img :src="sezon.logo_path" width="150px"></router-link>
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
  props:['id'],
  data() {
    return {
      sezons: null,
      serial:null,
      logo:'',
      desc:'',
      start:'',
      finish:'',
    }
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
    },
    handleFileUpload(){
      this.logo = this.$refs.file.files[0];
    },
    submitAddSezon(){
      var data = new FormData();
      data.append('logo', this.logo);
      data.append('finish', this.finish);
      data.append('desc', this.desc);
      data.append('start', this.start);
      data.append('serial_id', this.id);
      axios.post('/api/sezon/store',
          data,
          {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        }
      ).then(response => {
        this.sezons.push(response.data);
      });
    }
  }
}
</script>