<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Serial</div>

                <div class="card-body">
                    <form v-on:submit.prevent="submitAddSerial">
                        <div class="form-group">
                            <label for="serialName">Name</label>
                            <input type="text" class="form-control" id="serialName" placeholder="Enter name serial" v-model="name">
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
                            <label for="serialStart">Start Date</label>
                            <input type="date" class="form-control" id="serialStart" v-model="start">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <hr>
                    <div class="row">
                      <div v-for="serial in serials">
                        <router-link :to="{ name: 'admin_sezons', params: { id: serial.id }}" class="nav-link">
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
      serials:[],
      name:'',
      logo:'',
      desc:'',
      start:'',
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    handleFileUpload(){
      this.logo = this.$refs.file.files[0];
    },
    fetchData(){
      axios.get('/api/serials')
        .then(response => {
          this.serials = response.data;
        });
    },
    submitAddSerial(){
      var data = new FormData();
      data.append('logo', this.logo);
      data.append('name', this.name);
      data.append('desc', this.desc);
      data.append('start', this.start);
      axios.post('/api/serial/store',
          data,
          {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        }
      ).then(response => {
        this.serials.push(response.data);
      });
    }
  }
}
</script>