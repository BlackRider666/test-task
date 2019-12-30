<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Sezon to {{getSerial.name}}</div>

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
                    <hr>
                    <div class="row">
                        <div class="col-md" v-for="sezon in getSezons">
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
import {mapGetters} from 'vuex';
export default {
  props:['id'],
  data() {
    return {
      logo:'',
      desc:'',
      start:'',
      finish:'',
    }
  },
  computed: mapGetters(['getSerial','getSezons']),
  mounted(){
    this.$store.commit('changeLoading');
    this.$store.dispatch('getSerial',this.id);
    this.$store.commit('changeLoading');
  },
  methods: {
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
      this.$store.dispatch('addSezon',data);
    }
  }
}
</script>