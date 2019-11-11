<template>
	<div>
		<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" @submit.prevent="register">
                <div class="form-group row">
                  <div class="col-sm-12">
                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Name" v-model="form.name">
                    <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" v-model="form.email">
                  <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" v-model="form.password">
                    <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" v-model="form.password_confirmation">
                  </div>
                </div>
                  <button class="btn btn-primary btn-user btn-block" type="submit">
                      Register
                  </button>
                <hr>
                <a href="index.html" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <router-link class="small" to="/" >Already have an account? Login!</router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

	</div>
</template>

<script type="text/javascript">
  export default {
  created(){
    if (User.loggedIn()) {
      this.$router.push({name: 'home'})
    }
  },
  data(){
    return {
      form: {
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
      }, 
      errors: {

      },
    }
  }, 
  methods: {
    register(){
      axios.post('/api/auth/register', this.form)
      .then(res => {
        User.reposneAfterLogin(res)
        Toast.fire({
          type: 'success',
          title: 'Signed in successfully'
        })
        this.$router.push({name: 'home'})
      })
      .catch(error => this.errors = error.response.data.errors)
    }
  }
}
</script>

<style type="text/css">
	
</style>