<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Epizod</div>

                <div class="card-body">
                    <form v-on:submit.prevent="submitAddEpizod">
                        <div class="form-group">
                            <label for="serialName">Name</label>
                            <input type="text" class="form-control" id="serialName" placeholder="Enter name epizod" v-model="name">
                        </div>
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
                            <label for="serialStart">Release</label>
                            <input type="date" class="form-control" id="serialStart" v-model="release">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <hr>
                    <div class="row">
                        <div class="col-md" v-for="epizod in epizods">
                          <router-link :to="{ name: 'epizod_show', params: { id: epizod.id }}" class="nav-link"><img :src="epizod.logo_path" width="150px"><p>{{epizod.name}}</p></router-link>
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
      epizods:null,
      name:'',
      logo:'',
      desc:'',
      release:'',
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
          this.epizods = response.data.epizods;
        });
    },
    handleFileUpload(){
      this.logo = this.$refs.file.files[0];
    },
    submitAddEpizod(){
      var data = new FormData();
      data.append('logo', this.logo);
      data.append('name', this.name);
      data.append('desc', this.desc);
      data.append('release', this.release);
      data.append('sezon_id', this.id);
      axios.post('/api/epizod/store',
          data,
          {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        }
      ).then(response => {
        this.epizods.push(response.data);
      });
    }
  }
}
</script>