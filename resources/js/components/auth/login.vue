<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form v-on:submit.prevent="onSubmit">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" v-model="email" autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" v-model="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                  Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
  name:"login",
  props:['app'],
  data(){
    return {
      email: '',
      password:'',
      errors:[],
    }
  },
  methods:{
    onSubmit(){
      this.errors = [];
      const data = {
        email: this.email,
        password: this.password
      }
      axios.post('/api/auth/login/',data)
      .then(response => {
        if(response.data.token){
          localStorage.token = response.data.token;
        }
      }).catch(error => {
        this.errors.push(error.response.data.error);
      });
    }
  }
}
</script>