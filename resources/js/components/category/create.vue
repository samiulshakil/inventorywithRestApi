<template>
  <div>

    <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <router-link to="/supplier" class="btn btn-sm btn-info mt-5" style="text-align: right">All Supplier</router-link>
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Insert New Supplier</h1>
              </div>
              <form class="user" @submit.prevent="categoryInsert" enctype="mulipart/form-data">
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="text" class="form-control form-control-user" id="" placeholder="category_name" v-model="form.category_name">
                    <small class="text-danger" v-if="errors.category_name">{{ errors.category_name[0] }}</small>
                  </div>
                </div> 

                  <button class="btn btn-primary btn-user btn-block" type="submit">
                      Submit
                  </button>
              </form>
              <hr>
              <h5>Submitted yesterday at 2.30pm</h5>
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
    if (!User.loggedIn()) {
      this.$router.push({name: '/'})
    }
  },
  data(){
    return {
      form: {
        category_name: '',
      }, 
      errors: {

      },
    }
  }, 
  methods: {

    categoryInsert() {
      axios.post('/api/category/', this.form)
      .then( () => {
        this.$router.push({ name: 'category' })
        Notification.success();
      })
      .catch(error => this.errors = error.response.data.errors)
    }
  }
}
</script>

<style type="text/css">
  
</style>